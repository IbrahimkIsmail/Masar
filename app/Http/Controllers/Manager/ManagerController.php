<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Kindergarten;
use App\Http\Resources\Dashboard\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ManagerController extends Controller
{
//    public function __construct(){
//        $this->middleware('auth:api');
//    }
    protected function guard()
    {
        return Auth::guard('manager');
    }

    public function me()
    {
        $managerAuth = $this->guard()->user();
        $managerAuth->kindergarten;
        return new Manager($managerAuth);
    }

    public function update(Request $request)
    {
        $manager = $this->guard()->user();

        $validator = Validator::make($request->all(), [
            'dob' => 'required',
//            'image' => 'required',
            'mobile_number' => 'required',
            'full_address' => 'required',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $manager->ps_id = $request->ps_id;
        $manager->dob = $request->dob;
        $manager->image = $request->image;
        $manager->mobile_number = $request->mobile_number;
        $manager->full_address = $request->full_address;
        $manager->name = $request->name;

        if (!empty($request->image)) {
            if ($manager->image != null) {
                $image_path = public_path('/uploads/managers_images/' . $manager->image);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $imageName = $request->image->hashName();
            $manager->image = $imageName;
            Image::make($request->image)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('/uploads/managers_images/' . $imageName));
            //end logo upload
        }
        if (!empty($request->password)) {
            $manager->password = bcrypt($request->password);
        }
        $manager->update();
        return response()->json(["success" => true]);
    }


    public function kindergarten()
    {
        $kindergarten = $this->guard()->user()->kindergarten;
        return new Kindergarten($kindergarten);
    }


    public function updateKindergartenData(Request $request)
    {
        $kindergarten = $this->guard()->user()->kindergarten;


        $validator = Validator::make($request->all(), [
            'ps_id' => 'required',
            'name' => 'required',
            'email' => 'required',
//            'logo' => 'required',
            'description' => 'required',
            'fax' => 'required',
            'facebook_url' => 'required',
            'instagram_url' => 'required',
            'mobile_number' => 'required',
            'phone_number' => 'required',
            'full_address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $kindergarten->ps_id = $request->ps_id;
        $kindergarten->name = $request->name;
        $kindergarten->email = $request->email;
        $kindergarten->logo = $request->logo;
        $kindergarten->description = $request->description;
        $kindergarten->fax = $request->fax;
        $kindergarten->facebook_url = $request->facebook_url;
        $kindergarten->instagram_url = $request->instagram_url;
        $kindergarten->mobile_number = $request->mobile_number;
        $kindergarten->phone_number = $request->phone_number;
        $kindergarten->full_address = $request->full_address;

        if (!empty($request->logo)) {
            if ($kindergarten->logo != null) {
                $image_path = public_path('/uploads/kindergarten_logos/' . $kindergarten->logo);
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            //logo upload
            $logoName = $request->logo->hashName();
            $kindergarten->logo = $logoName;
            Image::make($request->logo)
                ->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('/uploads/kindergarten_logos/' . $logoName));
            //end logo upload
        }
        $kindergarten->save();
        return response()->json(["success" => true]);
    }


}

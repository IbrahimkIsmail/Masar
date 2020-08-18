<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\ClassRooms;
use App\Model\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index()
    {
        $id = Auth::guard('manager')->user()->kindergarten->id;

        return new ClassRooms(ClassRoom::kindergarten_id($id)->get());

    }

    public function store(Request $request)
    {
        $auth =  Auth::guard('manager')->user();
        $kindergarten = $auth->kindergarten;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $classRoom = ClassRoom::create([
            'name' => $request->name,
            'level' => $request->level,
            'manager_id' => $auth->id,
            'kindergarten_id' => $kindergarten->id,
            'status' => $request->status,
        ]);

        return new \App\Http\Resources\Dashboard\ClassRoom($classRoom);
    }

    public function show($id)
    {
        return new \App\Http\Resources\Dashboard\ClassRoom(ClassRoom::id($id)->get());
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $classRoom = ClassRoom::find($id);
        $classRoom->update($request->only(['name', 'level','status']));


        return new \App\Http\Resources\Dashboard\ClassRoom($classRoom);
    }

    public function destroy($id)
    {
        $classRoom = ClassRoom::find($id);
        $classRoom->delete();

        return response()->json([
            'data' => "تم حذف الصف بنجاح"
        ], 200);
    }
}

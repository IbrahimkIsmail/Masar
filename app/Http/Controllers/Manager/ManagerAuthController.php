<?php

namespace App\Http\Controllers\Manager;

use App\Model\Kindergarten;
use App\Model\KindergartenSettings;
use App\Model\Manager;
use App\Model\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManagerAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager', ['except' => ['login', 'register']]); //  why except login ?
    }


    protected function guard()
    {
        return Auth::guard('manager');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ps_id' => 'required',
            'dob' => 'required',
//            'image' => 'required',
            'mobile_number' => 'required',
            'full_address' => 'required',
            'email' => 'required',
            'name' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'kindergarten_name' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $manager = Manager::create([
            'ps_id' => $request->ps_id,
            'dob' => $request->dob,
            'image' => $request->image,
            'mobile_number' => $request->mobile_number,
            'full_address' => $request->ps_id,
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),

        ]);
        $kindergarten = Kindergarten::create([
            'name' => request('kindergarten_name'),
            'manager_id' => $manager->id
        ]);
        KindergartenSettings::create([
            'kindergarten_id' =>$kindergarten->id
        ]);
        Subscription::create([
            'amount' => 0,
            'manager_id' => $manager->id,
            'kindergarten_id' => $kindergarten->id,
            'subscription_date' => now(),
            'expiration_date' => date("Y-m-d",strtotime(now())+ 1814400),
            'price_per_user' =>15,

        ]);
        return new \App\Http\Resources\Dashboard\ManagerKindergarten($manager);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $email = request('email');
        $password = request('password');
        $remember_me = request('remember_me') == 1 ? true : false;


        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }


        $manager = $request->user();
//        dd($manager);
        $tokenResult = $manager->createToken('manager');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
//        $manager = Manager::where('email', $email)->first();
//
//
//        $managerLogin = Auth::guard('manager')->attempt(['email' => $email,
//            'password' => $password], $remember_me);
//
//        if ($managerLogin) {
//            return new \App\Http\Resources\Dashboard\Manager($manager);
//        } else {
//            return response()->json(['error' => 'wrong username or password']);
//        }

    }

    public function logout()
    {
        $this->guard()->logout();
        return response()->json(['message' => 'logout successfully'], 200);
    }



//
//
//
//
//
//    public function login2(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|string|email',
//            'password' => 'required|string',
//            'remember_me' => 'boolean'
//        ]);
//        $credentials = request(['email', 'password']);
//        if(!Auth::attempt($credentials))
//            return response()->json([
//                'message' => 'Unauthorized'
//            ], 401);
//        $user = $request->user();
//        $tokenResult = $user->createToken('Personal Access Token');
//        $token = $tokenResult->token;
//        if ($request->remember_me)
//            $token->expires_at = Carbon::now()->addWeeks(1);
//        $token->save();
//        return response()->json([
//            'access_token' => $tokenResult->accessToken,
//            'token_type' => 'Bearer',
//            'expires_at' => Carbon::parse(
//                $tokenResult->token->expires_at
//            )->toDateTimeString()
//        ]);
//    }
//
//    /**
//     * Logout user (Revoke the token)
//     *
//     * @return [string] message
//     */
//    public function logout2(Request $request)
//    {
//        $request->user()->token()->revoke();
//        return response()->json([
//            'message' => 'Successfully logged out'
//        ]);
//    }
//
//    /**
//     * Get the authenticated User
//     *
//     * @return [json] user object
//     */
//    public function manager(Request $request)
//    {
//        return response()->json($request->user());
//    }
}

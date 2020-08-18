<?php

namespace App\Http\Controllers\Mobile\Stff;

use App\Model\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ps_id' => 'required',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $ps_id = request('ps_id');
        $password = request('password');
        $teacher = Teacher::where('ps_id', $ps_id)->with('classRoom')->with('subjects')->first();
        //$class_room = $teacher->class_room();

        if (!Auth::guard('teacher_web')->attempt(['ps_id' => $ps_id, 'password' => $password])) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }


        $tokenResult = $teacher->createToken('teacher');
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addWeeks(200);
        $token->save();
        return response()->json([
            'data' => $teacher,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

    }

}

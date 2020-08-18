<?php

namespace App\Http\Controllers\Mobile;

use App\Model\Father;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FatherAuthController extends Controller
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
        $father = Father::where('ps_id', $ps_id)->first();

        if (!Auth::guard('fa_web')->attempt(['ps_id' => $ps_id, 'password' => $password])) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }


        $tokenResult = $father->createToken('father');
        $token = $tokenResult->token;

        $token->expires_at = Carbon::now()->addWeeks(200);
        $token->save();
        return response()->json([
            'data' => $father,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);

    }

}

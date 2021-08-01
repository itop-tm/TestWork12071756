<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\Response;
use App\Models\User;

class SignInController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::wherePhoneNumber($request->phone_number)->first();
        
        error_if(!$user, 'USER_NOT_FOUND');
        error_if($user->is_blocked, 'USER_IS_BLOCKED');
        error_if($user->otp !== (int)$request->otp, 'INVALID_OTP');

        $result = $user->createToken('PAT');

        return response([
            'success' => true,
            'access_token' => $result->plainTextToken,
            'user' => [
                'firstname' => $user->firstname,
                'lastname'  => $user->lastname,
                'email'     => $user->email,
                'phone'     => $user->phone_number
            ]
        ]);
    }
}

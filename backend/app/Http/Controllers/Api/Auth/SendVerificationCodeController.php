<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class SendVerificationCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric|digits:11',
        ]);

        $user = User::wherePhoneNumber($request->phone_number)->first();

        error_if(!$user, 'USER_NOT_FOUND');

        $user->otp = 12345;

        $user->save();

        return response([
            'success' => true,
        ], Response::HTTP_OK);
    }
}

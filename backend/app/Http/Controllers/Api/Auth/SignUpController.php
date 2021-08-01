<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use Illuminate\Http\Response;
use App\Models\User;

class SignUpController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::wherePhoneNumber($request->phone_number)->first();

        error_if($user, 'ALREADY_EXISTS');

        $user = new User();

        $user->phone_number = $request->phone_number;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        
        $user->otp = 12345;

        return $user->save();

        return response([
            'success' => true
        ], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __invoke(Request $r)
    {
        currentUser()
            ->currentAccessToken()
            ->delete();

        return response([
            'success' => true
        ]);
    }
}

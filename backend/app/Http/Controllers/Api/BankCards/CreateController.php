<?php

namespace App\Http\Controllers\Api\BankCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BankCards\CreateRequest;
use Illuminate\Http\Response;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $user = currentUser();

        $user->addCard($request->only([
            'issuer',
            'cardholder_name',
            'number',
            'expires_at'
        ]));

        return response([
            'success' => true
        ], Response::HTTP_ACCEPTED);
    }
}

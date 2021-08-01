<?php

namespace App\Http\Controllers\Api\BankCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BankCards\UpdateRequest;
use Illuminate\Http\Response;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request)
    {
        $user = currentUser();

        $card = $user->bankCard()->whereId($request->id)->first();

        error_if(!$card, 'MODEL_NOT_FOUND');

        $card->update($request->only([
            'issuer',
            'cardholder_name',
            'number',
            'expires_at',
        ]));

        return response([
            'success' => true
        ], Response::HTTP_ACCEPTED);
    }
}

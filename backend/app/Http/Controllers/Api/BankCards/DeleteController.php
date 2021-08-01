<?php

namespace App\Http\Controllers\Api\BankCards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = currentUser();

        $card = $user->bankCard()->whereId($request->id)->first();

        error_if(!$card, 'MODEL_NOT_FOUND');

        $card->delete();

        return response([
            'success' => true
        ]);
    }
}

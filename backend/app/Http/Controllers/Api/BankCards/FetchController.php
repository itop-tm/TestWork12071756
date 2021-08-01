<?php

namespace App\Http\Controllers\Api\BankCards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\BankCard;

class FetchController extends Controller
{
    public function __invoke(Request $request)
    {
        $card = BankCard::whereId($request->id)->first();

        error_if(!$card, 'MODEL_NOT_FOUND');

        return response([
            'success' => true,
            'data'    => $card
        ], Response::HTTP_OK);
    }
}

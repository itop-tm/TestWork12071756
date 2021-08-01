<?php

namespace App\Http\Controllers\Api\BankCards;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaginatorCollection;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = currentUser();

        $cards = $user->bankCard()->paginate();

        return PaginatorCollection::collection($cards);
    }
}

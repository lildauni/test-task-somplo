<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSellerRequest;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function setData(CreateSellerRequest $request)
    {
        $seller = Seller::create($request->all());

        return response()->json([
            'success' => true,
            'seller' => $seller
        ]);
    }
}

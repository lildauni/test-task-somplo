<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSellerRequest;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function setData(CreateSellerRequest $request)
    {
        $data = $request->validated();
        $seller = Seller::create($data);

        return response()->json([
            'seller' => $seller
        ]);
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'seller_name' => $this->seller_name,
            'phone_names' => $this->products()->pluck('phone_name')
        ];
    }
}

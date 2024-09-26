<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsInCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'photo'                  => $this->photo,
            'title'                  => $this->title,
            'discount'               => $this->discount,
            'price'                  => $this->price,
            'total_price'            => $this->pivot->price * $this->pivot->quantity,
            'amount_after_discount'  => strval( $this->amountAfterDiscount ),
        ];
    }
}

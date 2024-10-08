<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsInOrderResource extends JsonResource
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
            'quantity'               => $this->pivot->quantity,
            'total'                  => strval( round( $this->pivot->price * $this->pivot->quantity, 2  )) 
        ];
    }
}

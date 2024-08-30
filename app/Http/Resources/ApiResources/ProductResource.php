<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'           => $this->id,
            'category_id'  => $this->category_id,
            'price'        => $this->price,
            'quantity'     => $this->quantity,
            'description'  => $this->description,
            'status'       => $this->status,
            'photo'        => asset( 'adminlte/img/' . ($this->photo ?? 'product.jpg')),
        ];
    }
}

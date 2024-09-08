<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'photo'          => asset( 'adminlte/img/' . ($this->photo ?? 'product' ) ),
            'web_link'       => $this->web_link,
            'products_count' => count( $this->products ),
            'status'         => $this->status,
        ];
    }
}

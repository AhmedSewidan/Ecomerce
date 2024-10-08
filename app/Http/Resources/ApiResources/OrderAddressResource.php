<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $city         = $this->city ?? null; 
        $governorate  = $city ? $city->governorate : null; 
        $country      = $governorate ? $governorate->country : null; 

        return [
            'id'             => $this->id,
            'title'          => $this->title,   
            'city'           => $city->title,
            'governorate'    => $governorate->title,
            'country'        => $country->title,
            'address_line'   => $this->address_line
        ];
    }
}

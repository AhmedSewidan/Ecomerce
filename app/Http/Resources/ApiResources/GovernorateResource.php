<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GovernorateResource extends JsonResource
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
            'country_id'   => $this->country_id,
            'title'        => $this->title,
        ];
    }
}

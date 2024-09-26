<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'client_id'     => $this->client_id,
            'address_id'    => $this->address_id,
            'status'        => $this->status,
            'total'         => $this->total,
        ];
    }
}

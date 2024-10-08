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
            'id'                         => $this->id,
            'client_id'                  => $this->client_id,
            'order_address_id'           => $this->order_address_id,
            'code'                       => $this->code,
            'products_count'             => count( $this->products ),
            'status'                     => $this->status,
            'comment'                    => $this->comment,
            'total'                      => strval( round( $this->total, 2 ) )
        ];
    }
}

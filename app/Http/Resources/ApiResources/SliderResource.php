<?php

namespace App\Http\Resources\ApiResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'image'          => $this->image,
            'slidable_type'  => strtolower( basename(str_replace('\\', '/', $this->slidable_type)) ),
            'slidable_id'    => $this->slidable_id,
        ];
    }
}

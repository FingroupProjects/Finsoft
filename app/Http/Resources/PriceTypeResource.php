<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'decription' => $this->description,
            'currency' => CurrencyResource::make($this->whenLoaded('currency')),
            'deleted_at' => $this->deleted_at

        ];
    }
}

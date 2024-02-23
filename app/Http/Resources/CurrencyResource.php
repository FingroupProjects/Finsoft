<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
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
            'digital_code' => $this->digital_code,
            'symbol_code' => $this->symbol_code,
            'exchangeRates' => ExchangeRateResource::collection($this->whenLoaded('exchangeRates')),
            'deleted_at' => $this->deleted_at,
        ];
    }
}

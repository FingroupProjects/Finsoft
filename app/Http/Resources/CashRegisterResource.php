<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashRegisterResource extends JsonResource
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
            'currency_id' => $this->currency_id,
            'currency' => $this->currency->name ?? '',
            'organization_id' => $this->organization_id,
            'organization' => $this->organization->name ?? '',
        ];
    }
}

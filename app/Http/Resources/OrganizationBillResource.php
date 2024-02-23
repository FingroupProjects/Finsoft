<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationBillResource extends JsonResource
{
    /**
     * Transform the resource into afdsn array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'currency' => CurrencyResource::make($this->whenLoaded('currency')),
            'organization' => OrganizationResource::make($this->whenLoaded('organizationдух')),
            'bill_number' => $this->bill_number,
            'deleted_at' => $this->deleted_at

        ];
    }
}

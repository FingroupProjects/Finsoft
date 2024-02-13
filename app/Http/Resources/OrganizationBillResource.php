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
            'currency_id' => $this->currency_id,
            'organization_id' => $this->organization_id,
            'bill_number' => $this->bill_number
        ];
    }
}

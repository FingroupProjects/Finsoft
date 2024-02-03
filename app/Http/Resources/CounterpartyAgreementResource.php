<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CounterpartyAgreementResource extends JsonResource
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
            'contract_number' => $this->contract_number,
            'date' => $this->date,
            'organization_id'=> $this->organization->name,
            'counterparty_id' => $this->counterparty->name,
            'contact_person' => $this->contact_person,
            'currency_id' => $this->currency->name,
            'payment_id' => $this->payment->name,
            'comment' => $this->comment,
            'price_type_id' => $this->price_type->name,
        ];
    }
}

<?php

namespace App\Repositories;

use App\DTO\CounterpartyAgreementDTO;
use App\Models\Counterparty;
use App\Models\CounterpartyAgreement;
use App\Repositories\Contracts\CounterpartyAgreementRepositoryInterface;
use Illuminate\Support\Collection;

class CounterpartyAgreementRepository implements CounterpartyAgreementRepositoryInterface
{
    public function index(): Collection
    {
        return CounterpartyAgreement::with(['organization', 'counterparty', 'currency', 'payment', 'priceType'])->get();
    }

    public function store(CounterpartyAgreementDTO $DTO)
    {
        CounterpartyAgreement::create([
            'name' => $DTO->name,
            'contract_number' => $DTO->contract_number,
            'date' => $DTO->date,
            'organization_id' => $DTO->organization_id,
            'counterparty_id' => $DTO->counterparty_id,
            'contact_person' => $DTO->contact_person,
            'currency_id' => $DTO->currency_id,
            'payment_id' => $DTO->payment_id,
            'comment' => $DTO->comment,
            'price_type_id' => $DTO->price_type_id,
        ]);
    }

    public function update(CounterpartyAgreement $counterpartyAgreement, CounterpartyAgreementDTO $DTO): CounterpartyAgreement
    {
        $counterpartyAgreement->update([
            'name' => $DTO->name,
            'contract_number' => $DTO->contract_number,
            'date' => $DTO->date,
            'organization_id' => $DTO->organization_id,
            'counterparty_id' => $DTO->counterparty_id,
            'contact_person' => $DTO->contact_person,
            'currency_id' => $DTO->currency_id,
            'payment_id' => $DTO->payment_id,
            'comment' => $DTO->comment,
            'price_type_id' => $DTO->price_type_id,
        ]);

        return $counterpartyAgreement->load(['organization', 'counterparty', 'currency', 'payment', 'priceType']);
    }
}

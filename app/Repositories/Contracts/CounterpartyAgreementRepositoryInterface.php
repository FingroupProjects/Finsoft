<?php

namespace App\Repositories\Contracts;

use App\DTO\CounterpartyAgreementDTO;
use App\Models\CounterpartyAgreement;
use Illuminate\Support\Collection;

interface CounterpartyAgreementRepositoryInterface
{
    public function index() :Collection;

    public function store(CounterpartyAgreementDTO $DTO);

    public function update(CounterpartyAgreement $counterparty, CounterpartyAgreementDTO $DTO) :CounterpartyAgreement;
}

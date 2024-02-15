<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\OrganizationBillDTO;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\OrganizationBill;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\OrganizationBillRepositoryInterface;
use Illuminate\Support\Collection;

class OrganizationBillRepository implements OrganizationBillRepositoryInterface
{

    public function index(): Collection
    {
        return OrganizationBill::with(['currency', 'organization'])->get();
    }

    public function store(OrganizationBillDTO $dto)
    {
        OrganizationBill::create(get_object_vars($dto));
    }

    public function update(OrganizationBill $bill, OrganizationBillDTO $dto): OrganizationBill
    {

        $bill->update(get_object_vars($dto));

        return $bill->load(['currency', 'organization']);
    }
}

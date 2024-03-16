<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\OrganizationBillDTO;
use App\Models\CashRegister;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\OrganizationBill;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\OrganizationBillRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\Sort;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class OrganizationBillRepository implements OrganizationBillRepositoryInterface
{
    use Sort, FilterTrait;

    public $model = OrganizationBill::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filterParams = $this->processSearchData($data);

        $query = $this->search($filterParams);

        $query = $this->filter($query, $filterParams);

        $query = $this->sort($filterParams, $query, ['organization', 'currency']);

        return $query->paginate($filterParams['itemsPerPage']);
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

    public function search(array $filterParams)
    {
        $query = $this->model::whereAny(['name', 'bill_number', 'date', 'comment'], 'like', '%' . $filterParams['search'] . '%');

        return $query->where(function ($query) use ($filterParams) {
            $query->orWhereHas('currency', function ($query) use ($filterParams) {
                $query->where('name', 'like', '%' . $filterParams['search'] . '%');
            })
                ->orWhereHas('organization', function ($query) use ($filterParams) {
                    $query->where('name', 'like', '%' . $filterParams['search'] . '%');
                });
        });
    }

    public function filter($query, array $data)
    {
        return $query->when($data['currency_id'], function ($query) use ($data) {
            return $query->where('currency_id', $data['currency_id']);
        });
    }
}

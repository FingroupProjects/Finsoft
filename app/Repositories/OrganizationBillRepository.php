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

        $query = $this->search($filterParams['search']);

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

    public function search(string $search)
    {
        return $this->model::whereAny(['name', 'bill_number',  'date', 'comment' ], 'like', '%' . $search . '%')
            ->orWhereHas('currency', function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('organization', function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
    }
}

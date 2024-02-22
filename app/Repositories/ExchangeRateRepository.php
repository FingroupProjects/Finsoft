<?php

namespace App\Repositories;

use App\DTO\CashRegisterDTO;
use App\DTO\EmployeeDTO;
use App\Models\CashRegister;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\ExchangeRate;
use App\Repositories\Contracts\CashRegisterRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Contracts\ExchangeRateInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ExchangeRateRepository implements ExchangeRateInterface
{
    use FilterTrait, ValidFields;

    public $model = ExchangeRate::class;

    public function index(Currency $currency, array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->model::search($filteredParams['search'])->where('currency_id', $currency->id);

        $query = $this->sort($filteredParams, $query);


        return $query->paginate($filteredParams['itemsPerPage']);
    }
}

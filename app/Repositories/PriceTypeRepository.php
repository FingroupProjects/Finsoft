<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\PriceTypeDTO;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\PriceType;
use App\Repositories\Contracts\PriceTypeRepository as PriceTypeRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Illuminate\Pagination\LengthAwarePaginator;

class PriceTypeRepository implements PriceTypeRepositoryInterface
{
    const ON_PAGE = 10;

    use ValidFields, FilterTrait;

    public $model = PriceType::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->model::search($filteredParams['search'])->query(function ($query) {
            $query->with(['currency']);
        });

        if (! is_null($filteredParams['orderBy']) && $this->isValidField($filteredParams['orderBy'])) {
            $query->orderBy($filteredParams['orderBy'], $filteredParams['direction']);
        }

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(PriceTypeDTO $DTO)
    {
        $this->model::create([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
        ]);
    }

    public function update(PriceType $priceType, PriceTypeDTO $DTO): PriceType
    {
        $priceType->update([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
        ]);

        return $priceType->load('currency');
    }
}

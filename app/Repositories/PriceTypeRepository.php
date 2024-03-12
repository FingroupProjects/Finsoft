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
use App\Traits\Sort;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class PriceTypeRepository implements PriceTypeRepositoryInterface
{
    const ON_PAGE = 10;

    use Sort, FilterTrait;

    public $model = PriceType::class;

    public function index(array $data): LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->search($filteredParams['search']);

        $query = $this->sort($filteredParams, $query, ['currency']);

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(PriceTypeDTO $DTO)
    {
        $this->model::create([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'description' => $DTO->description
        ]);
    }

    public function update(PriceType $priceType, PriceTypeDTO $DTO): PriceType
    {
        $priceType->update([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id,
            'description' => $DTO->description
        ]);

        return $priceType->load('currency');
    }

    public function search(string $search)
    {
        return $this->model::whereAny(['name', 'description'], 'like', '%' . $search . '%')
            ->orWhereHas('currency', function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            });
    }
}

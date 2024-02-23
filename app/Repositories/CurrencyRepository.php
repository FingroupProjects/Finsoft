<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\PriceType;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Traits\FilterTrait;
use App\Traits\ValidFields;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    use ValidFields, FilterTrait;

    public $model = Currency::class;

    public function index(array $data) :LengthAwarePaginator
    {
        $filteredParams = $this->processSearchData($data);

        $query = $this->model::search($filteredParams['search'])->query(function ($query) {
            $query->withTrashed();
        });



        $query = $this->sort($filteredParams, $query, []);

        return $query->paginate($filteredParams['itemsPerPage']);
    }

    public function store(CurrencyDTO $dto) :Currency
    {
        return $this->model::create([
            'name' => $dto->name,
            'digital_code' => $dto->digital_code,
            'symbol_code' => $dto->symbol_code,
        ]);
    }

    public function update(Currency $currency, CurrencyDTO $dto) :Currency
    {
        $currency->update([
            'name' => $dto->name,
            'digital_code' => $dto->digital_code,
            'symbol_code' => $dto->symbol_code,
        ]);

        return $currency;
    }

    public function delete(Currency $currency)
    {
        $currency->exchangeRates()->delete();

        PriceType::where('currency_id', $currency->id)->delete();

        $currency->delete();
    }

    public function addExchangeRate(Currency $currency, ExchangeRateDTO $dto)
    {
        $currency->exchangeRates()->create([
            'date' => Carbon::parse($dto->date),
            'value' => $dto->value,
        ]);
    }

    public function deleteExchangeRate(ExchangeRate $exchangeRate)
    {
        $exchangeRate->delete();
    }

    public function updateExchangeRate(ExchangeRate $exchangeRate, ExchangeRateDTO $dto)
    {
        $exchangeRate->update([
            'date' => $dto->date,
            'value' => $dto->value,
        ]);

        return $exchangeRate;
    }

    public function getCurrencyExchangeRateByCurrencyRate(Currency $currency): Collection
    {
        return $currency->exchangeRates()->get();
    }
}

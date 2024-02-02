<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface {


    public function store(CurrencyDTO $dto)
    {
        Currency::create([
            'name' => $dto->name,
            'digital_code' => $dto->digital_code,
            'symbol_code' => $dto->symbol_code
        ]);
    }

    public function update(Currency $currency, CurrencyDTO $dto) :Currency
    {
       $currency->update([
            'name' => $dto->name,
            'digital_code' => $dto->digital_code,
            'symbol_code' => $dto->symbol_code
        ]);

       return $currency;
    }

    public function delete(Currency $currency)
    {

    }

    public function addExchangeRate(Currency $currency, ExchangeRateDTO $dto)
    {
        $currency->exchangeRates()->create([
            'date' => $dto->date,
            'value' => $dto->value
        ]);

        return $currency->exchangeRates()->get();
    }

    public function deleteExchangeRate(ExchangeRate $exchangeRate)
    {
        $exchangeRate->delete();
    }

    public function updateExchangeRate(ExchangeRate $exchangeRate, ExchangeRateDTO $dto)
    {
        $exchangeRate->update([
            'date' => $dto->date,
            'value' => $dto->value
        ]);

        return $exchangeRate;
    }
}

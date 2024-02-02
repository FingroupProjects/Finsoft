<?php

namespace App\Repositories\Contracts;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\Models\Currency;
use App\Models\ExchangeRate;


interface CurrencyRepositoryInterface {

    public function store(CurrencyDTO $dto);

    public function update(Currency $currency, CurrencyDTO $dto) :Currency;

    public function addExchangeRate(Currency $currency, ExchangeRateDTO $dto);

    public function deleteExchangeRate(ExchangeRate $exchangeRate);

    public function updateExchangeRate(ExchangeRate $exchangeRate, ExchangeRateDTO $dto);

    public function delete(Currency $currency);
}

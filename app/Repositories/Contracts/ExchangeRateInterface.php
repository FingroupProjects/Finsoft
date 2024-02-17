<?php

namespace App\Repositories\Contracts;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\Http\Requests\Api\IndexRequest;
use App\Http\Requests\CurrencyIndexRequest;
use App\Models\Currency;
use App\Models\ExchangeRate;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


interface ExchangeRateInterface {

    public function index(Currency $currency, array $data): LengthAwarePaginator;

    public function isValidField(string $field) :bool;
}

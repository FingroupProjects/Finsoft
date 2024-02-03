<?php

namespace App\Repositories;

use App\DTO\CurrencyDTO;
use App\DTO\ExchangeRateDTO;
use App\DTO\PriceTypeDTO;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\PriceType;
use App\Repositories\Contracts\PriceTypeRepository as PriceTypeRepositoryInterface;

class PriceTypeRepository implements PriceTypeRepositoryInterface {


    public function store(PriceTypeDTO $DTO)
    {
        PriceType::create([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id
        ]);
    }

    public function update(PriceType $priceType, PriceTypeDTO $DTO): PriceType
    {
        $priceType->update([
            'name' => $DTO->name,
            'currency_id' => $DTO->currency_id
        ]);

        return $priceType;
    }
}

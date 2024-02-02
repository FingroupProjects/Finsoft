<?php

namespace App\DTO;


use App\Http\Requests\Api\CurrencyRequest;
use App\Http\Requests\Api\ExchangeRequest;
use Illuminate\Auth\Events\Login;


class ExchangeRateDTO {

    public function __construct(public string $date, public float $value){ }


    public static function fromRequest(ExchangeRequest $request) :ExchangeRateDTO {
        return new static(
            $request->get('date'),
            $request->get('value')
        );
    }
}

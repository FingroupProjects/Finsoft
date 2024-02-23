<?php

namespace App\Rules;

use App\Models\ExchangeRate;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ExchangeRateRule implements Rule
{
    public function passes($attribute, $value) : bool
    {

        $currency = app('request')->route('currency');

        if (!$currency) {
            return false;
        }

        $date = ExchangeRate::where('currency_id', $currency->id)->latest()->first();

        if (!$date) return true;

        return !$date->isSameDay(Carbon::today());
    }

    public function message() : string
    {
        return 'Сегодня уже был записан курс валюты';
    }
}

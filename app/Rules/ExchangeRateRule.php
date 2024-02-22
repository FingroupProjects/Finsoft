<?php

namespace App\Rules;

use App\Models\ExchangeRate;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\Rule;

class ExchangeRateRule implements Rule
{
    public function passes($attribute, $value) : bool
    {
        $date = ExchangeRate::latest()->first();

        if (!$date) return true;

        $date = Carbon::parse($date->date);

        return !$date->isSameDay($value);
    }

    public function message() : string
    {
        return 'Сегодня уже был записан курс валюты';
    }
}

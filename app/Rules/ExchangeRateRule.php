<?php

namespace App\Rules;

use App\Models\ExchangeRate;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExchangeRateRule implements ValidationRule
{
    public function passes($attribute, $value) : bool
    {
        $date = ExchangeRate::latest();
    }

    public function message() : string
    {
        return 'Этот товар уже продан или не существует!';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JeroenG\Explorer\Application\Explored;
use Laravel\Scout\Searchable;

class Currency extends Model
{
    use Searchable;

    protected $fillable = ['name', 'digital_code', 'symbol_code'];

    public function exchangeRates() :HasMany
    {
        return $this->hasMany(ExchangeRate::class, 'currency_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'symbol_code' => $this->symbol_code,
            'digital_code' => $this->digital_code,
        ];
    }
}

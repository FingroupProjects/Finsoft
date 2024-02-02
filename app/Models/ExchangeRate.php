<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangeRate extends Model
{
    protected $fillable = ['date', 'currency_id', 'value'];

    public function currency() :BelongsTo
    {
       return $this->belongsTo(Currency::class, 'currency_id');
    }
}

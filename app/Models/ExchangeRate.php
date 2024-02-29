<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class ExchangeRate extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{
    use Searchable, SoftDeletes, HasFactory;

    protected $fillable = ['date', 'currency_id', 'value'];

    public function currency() :BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public static function bootSoftDeletes()
    {

    }



    public function toSearchableArray(): array
    {
        return [
            'value' => $this->value,
            'date' => $this->date,
        ];
    }
}

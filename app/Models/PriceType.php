<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class PriceType extends Model
{
    use Searchable;

    protected $fillable = ['name', 'currency_id'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name
        ];
    }

}


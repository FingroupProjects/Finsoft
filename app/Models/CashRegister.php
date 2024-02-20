<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\View\Compilers\Concerns\CompilesStyles;
use Laravel\Scout\Searchable;

class CashRegister extends Model
{
    use Searchable, CompilesStyles;

    protected $fillable = [
        'name',
        'currency_id',
        'organization_id'
    ];

    public function currency() :BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function organization() :BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}

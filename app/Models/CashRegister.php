<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\View\Compilers\Concerns\CompilesStyles;
use Laravel\Scout\Searchable;

class CashRegister extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{
    use Searchable, CompilesStyles, SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'currency_id',
        'organization_id',
        'responsible_person_id'
    ];

    public static function bootSoftDeletes()
    {

    }

    public function currency() :BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function organization() :BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'responsible_person_id', 'id');
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name
        ];
    }
}

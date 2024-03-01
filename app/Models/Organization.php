<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Organization extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{
    use Searchable, SoftDeletes, HasFactory;

    protected $fillable = ['name', 'address', 'description', 'INN', 'director_id', 'chief_accountant_id'];

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public static function bootSoftDeletes()
    {

    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'director_id', 'id');
    }

    public function chief_accountant(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'chief_accountant_id', 'id');
    }
}



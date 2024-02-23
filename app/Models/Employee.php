<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Employee extends Model
{
    use Searchable, SoftDeletes;

    protected $fillable = ['name', 'lastname', 'surname', 'image', 'position_id'];

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'lastname' => $this->lastname,
            'surname' => $this->surname
        ];
    }

    public static function bootSoftDeletes()
    {

    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}

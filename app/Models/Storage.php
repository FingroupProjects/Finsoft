<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Storage extends Model
{
    use Searchable;

    protected $guarded = false;

    public function employee() :BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function toSearchableArray() :array
    {
        return [
            'name' => $this->name
        ];
    }
}

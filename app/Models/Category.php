<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Searchable;

    public function toSearchableArray() :array
    {
        return [
            'name' => $this->name
        ];
    }

    protected $guarded = false;
}

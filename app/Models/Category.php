<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use Searchable, SoftDeletes, HasFactory;

    public function toSearchableArray() :array
    {
        return [
            'name' => $this->name
        ];
    }


    public static function bootSoftDeletes()
    {

    }
    protected $guarded = false;
}

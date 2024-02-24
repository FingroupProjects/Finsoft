<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Storage extends Model
{
    use Searchable, SoftDeletes;

    protected $guarded = false;

    public function employeeStorage() :hasOne
    {
        return $this->hasOne(EmployeeStorage::class);
    }

    public function toSearchableArray() :array
    {
        return [
            'name' => $this->name
        ];
    }
    public static function bootSoftDeletes()
    {

    }

}

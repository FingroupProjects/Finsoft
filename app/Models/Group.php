<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = ['name'];


    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function storages(): HasMany
    {
        return $this->hasMany(Storage::class);
    }

}

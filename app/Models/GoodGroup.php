<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodGroup extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'is_good', 'is_service'];

    public function goods()
    {
        return $this->hasMany(Good::class);
    }

    public static function bootSoftDeletes()
    {

    }
}

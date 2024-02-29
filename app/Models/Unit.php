<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{
    use SoftDeletes, HasFactory;

    protected $guarded = false;
}

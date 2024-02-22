<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;

    protected $guarded = false;

    const PURCHASE = 1;

    const RETURN_TO_PROVIDER = 2;

    const SALE_TO_CLIENT = 3;

    const RETURN_FROM_CLIENT = 4;
}

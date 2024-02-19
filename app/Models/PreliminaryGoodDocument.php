<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreliminaryGoodDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'good_id',
        'amount',
        'price',
        'preliminary_document_id',
    ];
}

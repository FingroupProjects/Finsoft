<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CashRegister extends Model
{
    use Searchable;

    protected $fillable = [
        'name'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name
        ];
    }





}

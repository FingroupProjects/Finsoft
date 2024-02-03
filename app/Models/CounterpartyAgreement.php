<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterpartyAgreement extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function counterparty()
    {
        return $this->belongsTo(Counterparty::class, 'counterparty_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function payment()
    {
        return $this->belongsTo(Currency::class, 'payment_id');
    }

    public function price_type()
    {
        return $this->belongsTo(PriceType::class, 'price_type_id');
    }
}

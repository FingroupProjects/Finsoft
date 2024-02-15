<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CounterpartyAgreement extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function organization() :BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function counterparty() :BelongsTo
    {
        return $this->belongsTo(Counterparty::class, 'counterparty_id');
    }

    public function currency() :BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function payment() :BelongsTo
    {
        return $this->belongsTo(Currency::class, 'payment_id');
    }

    public function priceType() :BelongsTo
    {
        return $this->belongsTo(PriceType::class, 'price_type_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class OrganizationBill extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{

    use SoftDeletes, Searchable, HasFactory;


    protected $fillable = ['name', 'currency_id', 'bill_number', 'organization_id', 'date', 'comment'];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public static function bootSoftDeletes()
    {

    }
}

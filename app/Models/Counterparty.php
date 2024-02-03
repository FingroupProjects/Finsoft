<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Counterparty extends Model
{
    protected $guarded = false;


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'counterparty_roles', 'counterparty_id', 'role_id');
    }

}

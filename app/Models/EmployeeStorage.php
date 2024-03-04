<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeStorage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'storage_id',
        'employee_id',
        'organization_id',
        'from',
        'to'
    ];

    public function employee(): belongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function organization(): belongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStorage extends Model
{
    protected $fillable = [
        'storage_id',
        'employee_id',
        'organization_id',
        'from',
        'to'
    ];
}

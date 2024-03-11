<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model implements \App\Repositories\Contracts\SoftDeleteInterface
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['name', 'vendor_code', 'description', 'category_id', 'unit_id', 'barcode', 'storage_id'];

    public static function bootSoftDeletes()
    {

    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

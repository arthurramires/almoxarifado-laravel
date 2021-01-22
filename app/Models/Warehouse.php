<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['quantity', 'product_name', 'product_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

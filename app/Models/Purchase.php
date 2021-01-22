<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $fillable = ['purchase_date'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

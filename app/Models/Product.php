<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'type', 'description', 'value', 'link'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}

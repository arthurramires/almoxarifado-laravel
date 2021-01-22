<?php

namespace App\Repositories;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    public function findByProductId(int $productId)
    {
        return \DB::table('products')->where('id',  $productId)->first();
    }
}

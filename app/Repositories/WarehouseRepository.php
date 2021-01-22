<?php

namespace App\Repositories;
use App\Models\Warehouse;

class WarehouseRepository extends BaseRepository
{
    protected $warehouse;

    public function __construct(Warehouse $warehouse)
    {
        parent::__construct($warehouse);
    }

    public function update(int $productId, array $attributes): bool
    {
        return \DB::table('warehouses')->where('product_id',  $productId)->update($attributes);
    }

    public function findByProductId(int $productId)
    {
        return \DB::table('warehouses')->where('product_id',  $productId)->first();
    }
}

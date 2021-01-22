<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;

class WarehouseService
{
    protected $warehouseRespository;

    public function __construct(
        WarehouseRepository $warehouseRespository
    )
    {
        $this->warehouseRespository = $warehouseRespository;
    }

    public function register($attributes): object
    {
        return $this->warehouseRespository->save($attributes);
    }

    public function edit($id, $attributes): bool
    {
        return $this->warehouseRespository->update($id, $attributes);
    }

    public function findByProduct($productId): object
    {
        return $this->warehouseRespository->findByProductId($productId);
    }

    public function index(): object
    {
        return $this->warehouseRespository->all();
    }
}

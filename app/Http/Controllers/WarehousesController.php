<?php

namespace App\Http\Controllers;
use App\Services\WarehouseService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;


class WarehousesController extends Controller
{
    protected $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $customer = $this->warehouseService->index();

        return response()->json($customer);
    }
}

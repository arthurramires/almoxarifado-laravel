<?php

namespace App\Http\Controllers;

use App\Services\SaleService;
use App\Services\WarehouseService;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    protected $saleService;
    protected $warehouseService;

    public function __construct(SaleService $saleService, WarehouseService $warehouseService)
    {
        $this->saleService = $saleService;
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        return $this->saleService->getSales();
    }

    public function register(Request $request)
    {
        $sale = $this->saleService->register($request);

        return response()->json($sale);
    }
}

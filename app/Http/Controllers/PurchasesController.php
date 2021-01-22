<?php

namespace App\Http\Controllers;

use App\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{

    protected $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        return $this->purchaseService->getPurchases();
    }

    public function register(Request $request)
    {
        $purchase = $this->purchaseService->register($request);
        return response()->json($purchase);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\WarehouseService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    protected $productService, $warehouseService;

    public function __construct(ProductService $productService, WarehouseService $warehouseService)
    {
        $this->productService = $productService;
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $products = $this->productService->index();

        return $products;
    }

    public function register(Request $request)
    {
        $attributes = $request->all();

        $verifyLink =  array_key_exists('link', $attributes);

        if($attributes['type'] === 1 && $verifyLink === false){
            throw new HttpResponseException(response()->json(['error' => 'O campo Link é obrigatório.'], 400));
        }

        $product = $this->productService->register($request);
        $this->warehouseService->register([
            'product_id' => $product->id,
            'product_name' => $product->name
        ]);

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        $verifyLink =  array_key_exists('link', $attributes);

        if($attributes['type'] === 1 && $verifyLink === false){
            throw new HttpResponseException(response()->json(['error' => 'O campo Link é obrigatório.'], 400));
        }

        $product = $this->productService->edit($attributes, $id);
        $this->warehouseService->edit($id, [
            'product_name' => $attributes['name']
        ]);

        if($product === true){
            return response()->json(['success' => 'Produto atualizado com sucesso']);
        }else {
            return response()->json(['error' => 'Ocorreu um erro ao atualizar seu produto']);
        }
    }
}

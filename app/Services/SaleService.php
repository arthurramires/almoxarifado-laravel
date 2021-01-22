<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use App\Repositories\WarehouseRepository;
use Error;
use ErrorException;
use Illuminate\Http\Request;

class SaleService
{
    protected $saleRespository;

    public function __construct(
        SaleRepository $saleRepository,
        WarehouseRepository $warehouseRepository,
        CustomerRepository $customerRepository,
        ProductRepository $productRepository,
    )
    {
        $this->saleRepository = $saleRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
    }

    public function register(Request $request)
    {
        $attributes = $request->all();

        $products = $attributes['products'];

        $total = 0;

        foreach($products as $item){
            $existingProduct = $this->productRepository->findByProductId($item['product_id']);
            $total = $total + ($item['quantity'] * $existingProduct->value);
        }

        $sale = $this->saleRepository->save([
            'customer_id' => $attributes['customer_id'],
            'value' => $total,
        ]);

        foreach($products as $product){

            $existingProduct = $this->warehouseRepository->findByProductId($product['product_id']);

            if($existingProduct === null){
                throw new ErrorException('Não existe um produto com o id: ' . $product['product_id'] . ' em estoque');
            }

            if($existingProduct->quantity < $product['quantity']){
                throw new Error('Não existe quantidade de: ' . $existingProduct->id . ' em estoque');
            }

            \DB::table('product_sale')->insert(
                [
                    'sale_id' => $sale->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity']
                ]
            );

            $this->warehouseRepository->update($product['product_id'], [
                'quantity' => $existingProduct->quantity + $product['quantity']
            ]);
        }
    }

    public function getSales(): object
    {
        $sale_purchases  = \DB::table('sale_purchase')->select('*')->get()->groupBy('sale_id');

        return $sale_purchases;
    }
}

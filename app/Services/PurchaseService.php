<?php
namespace App\Services;

use App\Repositories\PurchaseRepository;
use App\Repositories\WarehouseRepository;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\Request;

class PurchaseService
{
    protected $purchaseRepository;
    protected $warehouseRespository;

    public function __construct(
        PurchaseRepository $purchaseRepository,
        WarehouseRepository $warehouseRepository
    )
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->warehouseRepository = $warehouseRepository;
    }

    public function register(Request $request)
    {
        $attributes = $request->all();
        $purchase_date = Carbon::today();

        $purchase = $this->purchaseRepository->save([
            'purchase_date' => $purchase_date
        ]);

        $products = $attributes['products'];

        foreach($products as $product){

            $existingProduct = $this->warehouseRepository->findByProductId($product['product_id']);


            if($existingProduct === null){
                throw new ErrorException('Não existe um produto com o id: ' . $product['product_id'] . ' em estoque');
            }

            \DB::table('product_purchase')->insert(
                [
                    'purchase_id' => $purchase->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'purchase_date' => $purchase_date
                ]
            );

            $this->warehouseRepository->update($product['product_id'], [
                'quantity' => $existingProduct->quantity + $product['quantity']
            ]);
        }

        return $purchase;
    }

    public function getPurchases(): object
    {
        $product_purchase  = \DB::table('product_purchase')->select('*')->get()->groupBy('purchase_id');

        return $product_purchase;
    }
}

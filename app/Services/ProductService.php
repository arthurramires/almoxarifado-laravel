<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    protected $productRespository;

    public function __construct(
        ProductRepository $productRespository
    )
    {
        $this->productRespository = $productRespository;
    }

    public function register(Request $request)
    {
        $attributes = $request->all();

        if($attributes['type'] === 1){
           return $this->productRespository->save([
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'value' => $attributes['value'],
                'link' => $attributes['link'],
            ]);
        }else if($attributes['type'] === 0){
            return $this->productRespository->save($attributes);
        }
    }

    public function edit($attributes, $id)
    {
        if($attributes['type'] === "1"){
           return $this->productRespository->update($id, $attributes);
        }else if($attributes['type'] === 0){
            return $this->productRespository->update($id, $attributes);
        }
    }

    public function index()
    {
        return $this->productRespository->all();
    }

    public function show($id)
    {
        return $this->productRespository->find($id);
    }
}

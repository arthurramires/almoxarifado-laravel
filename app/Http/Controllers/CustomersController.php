<?php

namespace App\Http\Controllers;
use App\Services\CustomerService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;


class CustomersController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function register(Request $request)
    {
        $email = $request['email'];
        $attributes = $request->all();
        $existingCustomer = $this->customerService->findByEmail($email);

        if(count($existingCustomer) !== 0){
            throw new HttpResponseException(response()->json(['error' => 'Já existe um cliente com este email.'], 400));
        }

        if(strlen($request['document']) !== 11){
            throw new HttpResponseException(response()->json(['error' => 'Seu documento de CPF precisa ter 11 dígitos.'], 400));
        }

        $customer = $this->customerService->register($attributes);

        return response()->json($customer);
    }
}

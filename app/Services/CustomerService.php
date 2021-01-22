<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService
{
    protected $customerRespository;

    public function __construct(
        CustomerRepository $customerRepository
    )
    {
        $this->customerRepository = $customerRepository;
    }

    public function register($attributes): object
    {
        return $this->customerRepository->save($attributes);
    }

    public function findByEmail($email): object
    {
        return $this->customerRepository->findByColumn('email', $email);
    }
}

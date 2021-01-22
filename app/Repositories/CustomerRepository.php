<?php

namespace App\Repositories;
use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

    public function findById($id): object
    {
        return \DB::table('customers')->where('id', $id)->first();
    }
}

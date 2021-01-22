<?php

namespace App\Repositories;
use App\Models\Purchase;

class PurchaseRepository extends BaseRepository
{
    protected $purchase;

    public function __construct(Purchase $purchase)
    {
        parent::__construct($purchase);
    }
}

<?php

namespace App\Repositories;
use App\Models\Sale;

class SaleRepository extends BaseRepository
{
    protected $sale;

    public function __construct(Sale $sale)
    {
        parent::__construct($sale);
    }
}

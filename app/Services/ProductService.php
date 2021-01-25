<?php

namespace App\Services;

use App\Models\Product;

class ProductService extends Service
{
    /**
     * ProductService constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }
}

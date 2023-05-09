<?php

namespace App\Abstracts;

use App\Repositories\Interfaces\Products\ProductRepositoryInterface;

abstract class AbstractsProductHasStorage
{
    /**
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public abstract function hasStorage(array $request, ProductRepositoryInterface $productRepository);
}

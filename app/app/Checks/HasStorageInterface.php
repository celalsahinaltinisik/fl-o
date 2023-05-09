<?php

namespace App\Checks;

use App\Repositories\Interfaces\Products\ProductRepositoryInterface;

interface HasStorageInterface
{
    /**
     * this func calculate
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function hasStorage(array $request, ProductRepositoryInterface $productRepository): mixed;
}

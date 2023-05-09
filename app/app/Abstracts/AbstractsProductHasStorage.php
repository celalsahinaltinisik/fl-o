<?php

namespace App\Abstracts;

abstract class AbstractsProductHasStorage
{
    /**
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public abstract function hasStorage(array $request, $productRepository);
}

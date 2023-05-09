<?php

namespace App\Checks;

interface HasStorageInterface
{
    /**
     * this func calculate
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function hasStorage(array $request, $productRepository): mixed;
}

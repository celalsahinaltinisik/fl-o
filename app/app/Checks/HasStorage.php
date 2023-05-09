<?php

namespace App\Checks;

use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Log;

class HasStorage implements HasStorageInterface
{

    /**
     * this func calculate
     * @param array $request
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function hasStorage(array $request, ProductRepositoryInterface $productRepository): mixed
    {
        try {
            $hasStorage = new ProductHasStorage();
            return $hasStorage->hasStorage($request, $productRepository);
        } catch (Exception $e) {
            Log::info('calculate error', [$e->getMessage()]);
            return false;
        }
    }
}

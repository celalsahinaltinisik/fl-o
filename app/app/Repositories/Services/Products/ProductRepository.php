<?php

namespace App\Repositories\Services\Products;

use App\Models\Product;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use App\Repositories\Services\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}

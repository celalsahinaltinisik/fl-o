<?php

namespace App\Repositories\Services\Products;

use App\Models\Product;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use App\Repositories\Services\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param array $columns
     * @param array $values
     * @return Collection
     */
    public function whereIn(array $columns = ['*'], array $values = []): Collection
    {
        return $this->newQuery()->whereIn('id', $values)->get($columns);
    }
}

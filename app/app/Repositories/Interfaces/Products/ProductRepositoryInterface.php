<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get whereIn models.
     *
     * @param array $columns
     * @param array $values
     * @return Collection
     */
    public function whereIn(array $columns = ['*'], array $values = []): Collection;
}

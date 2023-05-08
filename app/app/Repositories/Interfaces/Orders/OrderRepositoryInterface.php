<?php

namespace App\Repositories\Interfaces\Orders;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Summary of store
     * @param array $attributes
     * @return Model|bool
     */
    public function store(array $attributes): bool|Model;
}

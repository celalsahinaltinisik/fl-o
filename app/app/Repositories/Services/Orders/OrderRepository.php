<?php

namespace App\Repositories\Services\Orders;

use App\Models\Order;
use App\Repositories\Interfaces\Orders\OrderRepositoryInterface;
use App\Repositories\Services\BaseRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    /**
     * OrderRepository constructor.
     *
     * @param Order $model
     */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    /**
     * Author create
     * @param array $attributes
     * @return Model|bool
     */
    public function store(array $attributes): bool|Model
    {
        DB::beginTransaction();
        try {
            $store = $this->create($attributes);
            DB::commit();
            return $store;
        } catch (Exception $e) {
            DB::rollBack();
            Log::info('order store', [$e->getMessage()]);
            return false;
        }
    }
}

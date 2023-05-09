<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Orders\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use ApiResponse;
use App\Checks\HasStorageInterface;
use App\Events\OrderStoreEvent;
use App\Models\Order;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use App\Requests\Orders\OrderStoreRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private $orderRepository;
    private $hasStorage;
    private $productRepository;
    /**
     * Summary of __construct
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     * @param HasStorageInterface $hasStorageInterface
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        HasStorageInterface $hasStorage
    ) {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->hasStorage = $hasStorage;
    }

    /**
     * Register an Order.
     * @param  OrderStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStoreRequest $request): JsonResponse
    {
        try {
            $orderNumber = Order::generateOrderNumber();

            $orders = $this->orderArrayOrganize(request: $request, orderNumber: $orderNumber);

            OrderStoreEvent::dispatch($orders);

            return ApiResponse::successResponse(
                data: ['number' => str_replace(search:'#', replace:'', subject: $orderNumber)],
                message: 'Order successfully registered',
                code: Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            return ApiResponse::errorResponse(message: 'Error: ' . $e->getMessage(), code: 403);
        }
    }

    /**
     * @param Request $request
     * @param string $orderNumber
     * @return array
     */
    private function orderArrayOrganize(Request $request, string $orderNumber): array
    {
            $productHasStorages = $this->hasStorage->hasStorage($request->all(), $this->productRepository);
            $orders['order_items'] = collect($request->all())->map(function ($data) use ($productHasStorages) {
                $product = $this->productRepository->find($data['product_id']);
                // ürün depo sipariş limit kontrolü
                return [
                    'product_id' => $data['product_id'],
                    'storage_id' => $productHasStorages[$data['product_id']],
                    'stock' => $data['stock'],
                    'price' =>  $product->price,
                   
                ];
            });
            $orders['order'] = [
                'number' => $orderNumber,
                'user_id' => auth()->user()->id,
                'total_price' => $orders['order_items']->sum('price'),
                'storages' => $productHasStorages,
            ];
            return $orders;
    }
}

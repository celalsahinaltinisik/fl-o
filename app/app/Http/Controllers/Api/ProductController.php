<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use ApiResponse;
use App\Requests\Products\ProductIndexRequest;
use App\Resources\Api\Products\ProductCollection;

class ProductController extends Controller
{
    private $productRepository;
    /**
     * Summary of __construct
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * List all products
     * @param ProductIndexRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ProductIndexRequest $request, $pageId, $perPage = 1): JsonResponse
    {
        request()->merge(['per_page' => $perPage, 'page_id' => $pageId]);
        $users = $this->productRepository->newQuery()->bootPaginate();
        return  ApiResponse::successResponse(data: new ProductCollection($users));
    }
}

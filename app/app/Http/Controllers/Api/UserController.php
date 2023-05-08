<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Resources\Api\Users\UserCollection;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use ApiResponse;
use App\Resources\Api\Users\UserResource;

class UserController extends Controller
{
    private $userRepository;
    /**
     * Summary of __construct
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * List all user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = $this->userRepository->newQuery()->latest('created_at')->first();
        return  ApiResponse::successResponse(data: new UserResource($user));
    }
}

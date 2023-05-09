<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'v1',
    'middleware' => ['api'],
], function () {
    Route::apiResource(
        name: 'users',
        controller: UserController::class
    )->only([
        'index',
    ]);

    Route::group([
        'middleware' => ['auth:sanctum'],
    ], function () {
        Route::apiResource(
            name: 'products/{pageId}/{perPage}',
            controller: ProductController::class
        )->only([
            'index',
        ]);
        
        Route::apiResource(
            name: 'orders',
            controller: OrderController::class
        )->only([
            'store',
            'show',
        ]);
    });
});
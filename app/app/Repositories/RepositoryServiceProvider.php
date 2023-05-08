<?php

namespace App\Repositories;

use App\Repositories\Interfaces\Orders\OrderRepositoryInterface;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use App\Repositories\Interfaces\Users\UserRepositoryInterface;
use App\Repositories\Services\Orders\OrderRepository;
use App\Repositories\Services\Products\ProductRepository;
use App\Repositories\Services\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            UserRepositoryInterface::class,
            UserRepository::class,
            ProductRepository::class,
            ProductRepositoryInterface::class,
            OrderRepository::class,
            OrderRepositoryInterface::class,
        ];
    }
}

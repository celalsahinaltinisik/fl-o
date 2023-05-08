<?php

namespace App\Helpers;

use Illuminate\Support\ServiceProvider;

class HelperFacadesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('apiresponse', function () {
            return new \App\Helpers\Api\ApiResponse;
        });
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
}

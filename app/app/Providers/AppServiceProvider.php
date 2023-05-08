<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder as DatabaseEloquentBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DatabaseEloquentBuilder::macro('bootPaginate', function ($perPage = null, $columns = ['*'], $pageName = 'page', $page = null) {
            $options = config('pagination');

            $perPage = $perPage ??
            request($options['param_name']) ?? $options['per_page'];
            $page = request('page_id') ?? $page;
            /** @var \Illuminate\Database\Eloquent\Builder $this */
            return $this->paginate($perPage, $columns, $pageName, $page);
        });
    }
}

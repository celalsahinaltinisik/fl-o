<?php

namespace App\Providers;

use App\Checks\HasStorage;
use App\Checks\HasStorageInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder as DatabaseEloquentBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HasStorageInterface::class, HasStorage::class);
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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            HasStorageInterface::class,
            HasStorage::class,
        ];
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\AddressDataRepository;
use App\Repositories\Contracts\AddressDataRepositoryInterface;
use App\Repositories\Eloquent\LocationRepository;
use App\Repositories\Contracts\LocationRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AddressDataRepositoryInterface::class,
            AddressDataRepository::class
        );

        $this->app->bind(
            LocationRepositoryInterface::class,
            LocationRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

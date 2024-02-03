<?php

namespace App\Providers;


use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\PriceTypeRepository;
use App\Repositories\CurrencyRepository;
use AuthRepository;
use AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->singleton(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->singleton(PriceTypeRepository::class, \App\Repositories\PriceTypeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

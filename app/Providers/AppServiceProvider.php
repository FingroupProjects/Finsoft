<?php

namespace App\Providers;


use App\Repositories\AuthRepository;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\CounterpartyAgreementRepositoryInterface;
use App\Repositories\Contracts\CounterpartyRepositoryInterface;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\OrganizationBillRepositoryInterface;
use App\Repositories\Contracts\PositionRepositoryInterface;
use App\Repositories\Contracts\PriceTypeRepository;
use App\Repositories\CounterpartyAgreementRepository;
use App\Repositories\CounterpartyRepository;
use App\Repositories\CurrencyRepository;

use App\Repositories\OrganizationBillRepository;
use App\Repositories\PositionRepository;
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
        $this->app->singleton(OrganizationBillRepositoryInterface::class, OrganizationBillRepository::class);
        $this->app->singleton(CounterpartyRepositoryInterface::class, CounterpartyRepository::class);
        $this->app->singleton(CounterpartyAgreementRepositoryInterface::class, CounterpartyAgreementRepository::class);
        $this->app->singleton(PositionRepositoryInterface::class, PositionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

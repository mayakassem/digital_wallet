<?php

namespace App\Providers;

use App\Builders\ProductBuilderInterface;
use App\Builders\ProductConcreteBuilder;
use App\Services\PayTechBankParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductBuilderInterface::class, ProductConcreteBuilder::class
    );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PayTechBankParser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PayTechBankParser::class, PayTechBankParser::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}

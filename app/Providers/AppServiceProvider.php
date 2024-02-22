<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\NewsListInterface;
use App\Services\TheGuardianService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NewsListInterface::class, function ($app) {
            return $app->make(request()->source === 'theguardian' ? TheGuardianService::class : TheGuardianService::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

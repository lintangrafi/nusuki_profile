<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MetaTagService;
use App\Services\ImageOptimizationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ImageOptimizationService::class, function () {
            return new ImageOptimizationService();
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

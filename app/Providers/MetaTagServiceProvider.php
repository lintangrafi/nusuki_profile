<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MetaTagService;

class MetaTagServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(MetaTagService::class, function () {
            return new MetaTagService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Services\DesignPatterns\DesignPatternService;
use App\Services\TargetClass\TargetClassService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DesignPatternService::class, function() {
            return new DesignPatternService();
        });

        $this->app->singleton(TargetClassService::class, function() {
            return new TargetClassService();
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

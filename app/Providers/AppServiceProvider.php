<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\Auth::class);
        $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\Admin::class);
    }

    protected function getDatabaseConnection()
    {
        // $connection = config('session.connection');

        // return DB::connection($connection);
    }
}

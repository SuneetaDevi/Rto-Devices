<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Safely get tenant
        $tenant = app()->bound('currentTenant') ? app('currentTenant') : null;

        // Safely get store
        $store = app()->bound('currentStore') ? app('currentStore') : null;

        // Share globally
        View::share('tenant_domain', $tenant->domain ?? null);
        View::share('store', $store->store_name ?? null);
    }

}

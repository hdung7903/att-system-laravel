<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\GroupDropdown;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('group-dropdown', GroupDropdown::class);
    }
}

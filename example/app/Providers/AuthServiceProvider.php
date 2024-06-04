<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Example gate definition
        Gate::define('view-home', function (User $user) {
            return $user->hasRole('admin') || $user->hasRole('instructor')|| $user->hasRole('student')|| $user->hasRole('instructor');
        });
    }
}

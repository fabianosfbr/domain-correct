<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(User::class, UserPolicy::class);
        Gate::define('accessDomainCorrectResource', [UserPolicy::class, 'accessDomainCorrectResource']);
        Gate::define('accessNotCorrectHistoricalResource', [UserPolicy::class, 'accessNotCorrectHistoricalResource']);
        Gate::define('accessUserResource', [UserPolicy::class, 'accessUserResource']);
    }
}

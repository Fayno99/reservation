<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
        $this->registerPolicies();

//        Gate::define('view-day-off', function ($user) {
//            return $user->isAdmin()||$user->isManager();
//        });
//
//        Gate::define('view-schedules', function ($user) {
//            return $user->isAdmin()||$user->isAssistant();
//        });

    }




}

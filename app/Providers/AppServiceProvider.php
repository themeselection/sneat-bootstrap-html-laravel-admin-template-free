<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::if('perm', function (string $permission): bool {
            if (!auth()->check()) {
                return false;
            }

            $user = auth()->user();
            if (!$user || !method_exists($user, 'hasPermission')) {
                return false;
            }

            return (bool) $user->hasPermission($permission);
        });
    }
}

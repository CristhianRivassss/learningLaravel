<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        
        // Gates con NUEVA estructura de roles (tabla pivote)
        Gate::define('manage-users', function ($user) {
            // Verificar si tiene rol admin o editor
            return $user->hasRole('admin') || $user->hasRole('editor');
        });
        
        Gate::define('admin-only', function ($user) {
            // Solo admins pueden pasar
            return $user->hasRole('admin');
        });
        
        Gate::define('user-authenticated', function ($user) {
            // Cualquier usuario logueado puede pasar
            return true; // Si llega aquí, ya está autenticado
        });
        
        // Nuevos Gates más específicos
        Gate::define('moderator-access', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('moderador');
        });
        
        Gate::define('financial-access', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('contador');
        });
        
        Gate::define('editor-access', function ($user) {
            return $user->hasRole('admin') || $user->hasRole('editor');
        });
    }
}

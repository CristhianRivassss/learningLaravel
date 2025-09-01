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
        
        // Gates HÍBRIDOS: Funcionan con tabla roles O campo role (string)
        Gate::define('manage-users', function ($user) {
            // Obtener el nombre del rol usando el helper
            $roleName = $user->getRoleName();
            
            // Verificar si tiene permisos para gestionar usuarios
            return in_array($roleName, ['admin', 'editor']);
        });
        
        Gate::define('admin-only', function ($user) {
            // Obtener el nombre del rol usando el helper
            $roleName = $user->getRoleName();
            
            // Solo admins pueden pasar
            return $roleName === 'admin';
        });
        
        // Nuevos Gates más específicos
        Gate::define('moderator-access', function ($user) {
            $roleName = $user->getRoleName();
            return in_array($roleName, ['admin', 'moderador']);
        });
        
        Gate::define('financial-access', function ($user) {
            $roleName = $user->getRoleName();
            return in_array($roleName, ['admin', 'contador']);
        });
    }
}

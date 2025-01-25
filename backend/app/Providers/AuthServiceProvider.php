<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * El arreglo de políticas de autenticación de la aplicación.
     *
     * @var array
     */
    protected $policies = [
        // Aquí van tus políticas si las tienes
    ];

    public function boot()
    {
        $this->registerPolicies();
        
        Passport::routes();
    }
}

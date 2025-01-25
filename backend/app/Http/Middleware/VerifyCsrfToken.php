<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Las rutas que deberían ser excluidas de la verificación de CSRF.
     *
     * @var array
     */
    protected $except = [
        'login',
    ];

    public function handle($request, Closure $next)
    {
        return parent::handle($request, $next);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'stripe/webhook', // ✅ AJOUTÉ - Stripe doit pouvoir envoyer des webhooks sans CSRF
        'api/*', // ✅ Conserve l'exclusion des routes API
    ];
}
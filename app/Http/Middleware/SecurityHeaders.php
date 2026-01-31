<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Headers de sécurité à appliquer sur toutes les réponses.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Protection contre le clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Empêcher le MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Protection XSS (navigateurs modernes)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Referrer Policy - envoyer le referrer uniquement pour same-origin
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy - désactiver les fonctionnalités sensibles
        $response->headers->set('Permissions-Policy', 'geolocation=(self), microphone=(), camera=()');

        // HSTS - forcer HTTPS (uniquement en production)
        if (app()->environment('production') && $request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        return $response;
    }
}

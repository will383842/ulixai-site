<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Headers de sécurité à appliquer sur toutes les réponses.
     *
     * SECURITY HEADERS:
     * - X-Frame-Options: Prevent clickjacking
     * - X-Content-Type-Options: Prevent MIME sniffing
     * - X-XSS-Protection: Legacy XSS protection
     * - Content-Security-Policy: Prevent XSS and injection attacks
     * - Referrer-Policy: Control referrer information
     * - Permissions-Policy: Disable sensitive browser features
     * - Strict-Transport-Security: Force HTTPS
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // ═══════════════════════════════════════════════════════════
        // 🔐 CLICKJACKING PROTECTION
        // ═══════════════════════════════════════════════════════════
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // ═══════════════════════════════════════════════════════════
        // 🔐 MIME SNIFFING PROTECTION
        // ═══════════════════════════════════════════════════════════
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // ═══════════════════════════════════════════════════════════
        // 🔐 LEGACY XSS PROTECTION (for older browsers)
        // ═══════════════════════════════════════════════════════════
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // ═══════════════════════════════════════════════════════════
        // 🔐 CONTENT SECURITY POLICY - Prevents XSS attacks
        // ═══════════════════════════════════════════════════════════
        $csp = $this->buildContentSecurityPolicy();
        $response->headers->set('Content-Security-Policy', $csp);

        // ═══════════════════════════════════════════════════════════
        // 🔐 REFERRER POLICY
        // ═══════════════════════════════════════════════════════════
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // ═══════════════════════════════════════════════════════════
        // 🔐 PERMISSIONS POLICY - Disable sensitive features
        // ═══════════════════════════════════════════════════════════
        $response->headers->set('Permissions-Policy',
            'geolocation=(self), ' .
            'microphone=(), ' .
            'camera=(), ' .
            'payment=(self), ' .
            'usb=(), ' .
            'magnetometer=(), ' .
            'gyroscope=(), ' .
            'accelerometer=()'
        );

        // ═══════════════════════════════════════════════════════════
        // 🔐 HSTS - Force HTTPS (production only)
        // ═══════════════════════════════════════════════════════════
        if (app()->environment('production') && $request->secure()) {
            $response->headers->set('Strict-Transport-Security',
                'max-age=31536000; includeSubDomains; preload'
            );
        }

        // ═══════════════════════════════════════════════════════════
        // 🔐 ADDITIONAL SECURITY HEADERS
        // ═══════════════════════════════════════════════════════════
        // Prevent browser from caching sensitive pages
        if ($this->isSensitivePage($request)) {
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
        }

        return $response;
    }

    /**
     * Build Content Security Policy header.
     *
     * @return string
     */
    private function buildContentSecurityPolicy(): string
    {
        $directives = [
            // Default: only allow from same origin
            "default-src 'self'",

            // Scripts: self + trusted CDNs + inline for legacy compatibility
            // NOTE: Remove 'unsafe-inline' when migrating to nonce-based CSP
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' " .
                "https://js.stripe.com " .
                "https://www.paypal.com " .
                "https://www.google.com " .
                "https://www.gstatic.com " .
                "https://www.googletagmanager.com " .
                "https://www.google-analytics.com " .
                "https://translate.google.com " .
                "https://translate.googleapis.com " .
                "https://cdn.jsdelivr.net " .
                "https://cdnjs.cloudflare.com " .
                "https://js.pusher.com " .
                "https://stats.pusher.com",

            // Styles: self + trusted CDNs + inline for Tailwind
            "style-src 'self' 'unsafe-inline' " .
                "https://fonts.googleapis.com " .
                "https://cdnjs.cloudflare.com " .
                "https://cdn.jsdelivr.net " .
                "https://translate.googleapis.com",

            // Images: self + data URIs + trusted sources
            "img-src 'self' data: blob: " .
                "https: " . // Allow HTTPS images (profiles, etc.)
                "https://www.google.com " .
                "https://www.gstatic.com " .
                "https://translate.google.com " .
                "https://www.google-analytics.com " .
                "https://www.googletagmanager.com",

            // Fonts: self + Google Fonts
            "font-src 'self' data: " .
                "https://fonts.gstatic.com " .
                "https://cdnjs.cloudflare.com",

            // Connections: self + APIs
            "connect-src 'self' " .
                "https://api.stripe.com " .
                "https://www.paypal.com " .
                "https://www.google-analytics.com " .
                "https://stats.pusher.com " .
                "https://sockjs.pusher.com " .
                "wss://*.pusher.com " .
                "https://translate.googleapis.com " .
                "https://cloudflareinsights.com",

            // Frames: Stripe, PayPal, Google Translate
            "frame-src 'self' " .
                "https://js.stripe.com " .
                "https://hooks.stripe.com " .
                "https://www.paypal.com " .
                "https://www.google.com " .
                "https://translate.google.com " .
                "https://www.recaptcha.net",

            // Form actions: only same origin
            "form-action 'self'",

            // Frame ancestors: prevent clickjacking (same as X-Frame-Options)
            "frame-ancestors 'self'",

            // Base URI: prevent base tag injection
            "base-uri 'self'",

            // Object/embed: disable plugins
            "object-src 'none'",

            // Upgrade insecure requests in production
            app()->environment('production') ? "upgrade-insecure-requests" : "",
        ];

        // Filter out empty directives and join
        return implode('; ', array_filter($directives));
    }

    /**
     * Check if the current request is for a sensitive page.
     *
     * @param Request $request
     * @return bool
     */
    private function isSensitivePage(Request $request): bool
    {
        $sensitivePaths = [
            'login',
            'register',
            'password',
            'account',
            'dashboard',
            'admin',
            'payment',
            'checkout',
        ];

        foreach ($sensitivePaths as $path) {
            if ($request->is($path) || $request->is($path . '/*')) {
                return true;
            }
        }

        return false;
    }
}

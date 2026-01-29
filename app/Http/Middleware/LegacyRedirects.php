<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware pour rediriger les anciennes URLs WordPress vers les nouvelles URLs Laravel.
 *
 * Ce middleware gère la migration SEO depuis l'ancien site WordPress.
 * Toutes les redirections sont en 301 (permanent) pour préserver le SEO.
 */
class LegacyRedirects
{
    /**
     * Redirections statiques : ancienne URL => nouvelle URL
     */
    protected array $staticRedirects = [
        // ═══════════════════════════════════════════════════════════
        // 📄 PAGES STATIQUES
        // ═══════════════════════════════════════════════════════════

        // Pages d'information
        '/comment-ca-marche' => '/',
        '/comment-ca-marche/' => '/',
        '/confiance-et-securite' => '/',
        '/confiance-et-securite/' => '/',
        '/qui-sommes-nous' => '/aboutUS',
        '/qui-sommes-nous/' => '/aboutUS',
        '/contactez-nous' => '/',
        '/contactez-nous/' => '/',

        // Pages légales
        '/mentions-legales' => '/legal-notice',
        '/mentions-legales/' => '/legal-notice',
        '/conditions-generales' => '/termsnconditions',
        '/conditions-generales/' => '/termsnconditions',
        '/politique-de-confidentialite' => '/termsnconditions',
        '/politique-de-confidentialite/' => '/termsnconditions',
        '/gestion-des-cookies' => '/cookiemanagment',
        '/gestion-des-cookies/' => '/cookiemanagment',

        // Recrutement & Partenariats
        '/recrutement' => '/recruitment',
        '/recrutement/' => '/recruitment',
        '/partenaires' => '/partnerships',
        '/partenaires/' => '/partnerships',
        '/devenez-partenaires' => '/partnerships',
        '/devenez-partenaires/' => '/partnerships',
        '/formulaire-partenariat' => '/partnerships',
        '/formulaire-partenariat/' => '/partnerships',
        '/contact-partenariat' => '/partnerships',
        '/contact-partenariat/' => '/partnerships',

        // Devenir prestataire
        '/devenez-prestataire' => '/become-service-provider',
        '/devenez-prestataire/' => '/become-service-provider',
        '/inscription-prestataire-3' => '/become-service-provider',
        '/inscription-prestataire-3/' => '/become-service-provider',
        '/formulaire-prestataire-complet' => '/become-service-provider',
        '/formulaire-prestataire-complet/' => '/become-service-provider',

        // Affiliation
        '/inscription-affiliate' => '/affiliate/sign-up',
        '/inscription-affiliate/' => '/affiliate/sign-up',
        '/affiliate-reseaux-sociaux' => '/affiliate',
        '/affiliate-reseaux-sociaux/' => '/affiliate',

        // Authentification
        '/connexion' => '/login',
        '/connexion/' => '/login',
        '/connexion-3' => '/login',
        '/connexion-3/' => '/login',
        '/registration' => '/signup',
        '/registration/' => '/signup',
        '/inscription-2' => '/signup',
        '/inscription-2/' => '/signup',
        '/lost-password' => '/forgot-password',
        '/lost-password/' => '/forgot-password',

        // Espace utilisateur
        '/mon-espace' => '/dashboard',
        '/mon-espace/' => '/dashboard',
        '/my-account' => '/account',
        '/my-account/' => '/account',
        '/mes-informations-personnelles' => '/personal-info',
        '/mes-informations-personnelles/' => '/personal-info',
        '/mes-demandes-d-aide' => '/service-request',
        '/mes-demandes-d-aide/' => '/service-request',

        // Catégories
        '/categories-globales' => '/',
        '/categories-globales/' => '/',
        '/sous-categories' => '/',
        '/sous-categories/' => '/',
        '/sous-sous-categories' => '/',
        '/sous-sous-categories/' => '/',

        // Presse
        '/presse' => '/press',
        '/presse/' => '/press',

        // SOS / Urgences (supprimées)
        '/sos' => '/',
        '/sos/' => '/',
        '/sos-urgences' => '/',
        '/sos-urgences/' => '/',

        // Pages diverses
        '/guide-complet-sinstaller-etranger' => '/',
        '/lallie-des-francophones-a-letranger' => '/',
        '/author/ulixai_admin' => '/',
        '/author/ulixai_admin/' => '/',
        '/feed' => '/',
        '/feed/' => '/',

        // Version anglaise (non implémentée)
        '/en' => '/',
        '/en/' => '/',

        // ═══════════════════════════════════════════════════════════
        // 🔧 URLS TECHNIQUES À IGNORER
        // ═══════════════════════════════════════════════════════════

        // Anciennes URLs techniques
        '/recruit/apply' => '/recruitment',
        '/verify-email-otp' => '/signup',
        '/register' => '/signup',
        '/paymentsvalidate' => '/dashboard',
        '/partnership/store' => '/partnerships',
        '/logout' => '/login', // GET logout n'existe pas en Laravel (POST only)
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->path(), '/');

        // ═══════════════════════════════════════════════════════════
        // 1. Redirections statiques exactes
        // ═══════════════════════════════════════════════════════════
        if (isset($this->staticRedirects[$path])) {
            return redirect($this->staticRedirects[$path], 301);
        }

        // ═══════════════════════════════════════════════════════════
        // 2. Patterns dynamiques
        // ═══════════════════════════════════════════════════════════

        // Anciennes URLs de formulaires WordPress avec cat_id
        // /formulaire-standard/?cat_id=xxx => /create-request
        if (preg_match('#^/formulaire-(standard|xxxxxx)/?$#i', $path)) {
            return redirect('/create-request', 301);
        }

        // /sous-categories/sous-sous-categories?cat_id=xxx => /
        if (preg_match('#^/sous-categories/sous-sous-categories/?$#i', $path)) {
            return redirect('/', 301);
        }

        // /sous-sous-categories/?cat_id=xxx => /
        if (preg_match('#^/sous-sous-categories/?$#i', $path)) {
            return redirect('/', 301);
        }

        // /sous-categories?cat_id=xxx => /
        if (preg_match('#^/sous-categories/?$#i', $path)) {
            return redirect('/', 301);
        }

        // Anciennes URLs providers (plural => singular)
        // /providers/xxx => /provider/xxx
        if (preg_match('#^/providers/(.+)$#', $path, $matches)) {
            $slug = $matches[1];
            // Ignorer les URLs avec .php ou request-for-help
            if (!str_contains($slug, '.php') && $slug !== 'request-for-help.php') {
                return redirect('/provider/' . $slug, 301);
            }
            // Sinon, 404 (fichiers PHP n'existent plus)
            abort(404);
        }

        // URLs avec /public/index.php/ (mauvaise config serveur)
        if (str_starts_with($path, '/public/index.php/')) {
            $cleanPath = str_replace('/public/index.php', '', $path);

            // Si c'est un provider, rediriger directement vers /provider/slug (évite double redirection)
            if (preg_match('#^/providers/(.+)$#', $cleanPath, $matches)) {
                $slug = $matches[1];
                if (!str_contains($slug, '.php')) {
                    return redirect('/provider/' . $slug, 301);
                }
                abort(404);
            }

            return redirect($cleanPath, 301);
        }

        // ═══════════════════════════════════════════════════════════
        // 3. Bloquer les anciens fichiers PHP WordPress
        // ═══════════════════════════════════════════════════════════

        // Fichiers .php qui n'existent plus
        if (str_ends_with($path, '.php')) {
            abort(404, 'Cette page n\'existe plus.');
        }

        // Fichiers WordPress (wp-content, wp-admin, etc.)
        if (preg_match('#^/wp-(content|admin|includes)/#', $path)) {
            abort(404);
        }

        // ═══════════════════════════════════════════════════════════
        // 4. URLs avec template variables non résolus
        // ═══════════════════════════════════════════════════════════

        // /provider-details/${provider.id} => 404
        if (str_contains($path, '${')) {
            abort(404, 'URL invalide');
        }

        // /${cat.icon_image} => 404
        if (str_starts_with($path, '/${')) {
            abort(404);
        }

        return $next($request);
    }
}

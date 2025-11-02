<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Services\Seo\BingWebmasterClient;
use App\Services\Seo\OpenPageRankClient;

class SeoAnalyticsController extends Controller
{
    /**
     * Page SEO & Analytics (vue Blade)
     * - Ne change rien aux routes ni payloads existants.
     * - Utilise le cache si disponible pour l'affichage initial.
     */
    public function index(Request $request)
    {
        $metrics = Cache::get('seo.metrics.latest', [
            'bing' => [
                'connected' => false,
                'summary'   => [],
                'error'     => null,
            ],
            'opr' => [
                'connected' => false,
                'rank'      => null,
                'error'     => null,
            ],
            'refreshed_at' => null,
        ]);

        return view('admin.seo-analytics.index', [
            'metrics' => $metrics,
        ]);
    }

    /**
     * Force un rafraîchissement (AJAX)
     * Agrège quelques métriques simples et met en cache 6h.
     * Ne casse rien si les clés API manquent: on log + on renvoie un statut.
     */
    public function refresh(Request $request, BingWebmasterClient $bing, OpenPageRankClient $opr)
    {
        $payload = [
            'bing' => ['connected' => false, 'summary' => [], 'error' => null],
            'opr'  => ['connected' => false, 'rank' => null, 'error' => null],
            'refreshed_at' => now()->toDateTimeString(),
        ];

        // Bing
        try {
            $payload['bing']['summary']   = $bing->summarizeLinkCounts();
            $payload['bing']['connected'] = (bool) ($payload['bing']['summary']['connected'] ?? false);
        } catch (\Throwable $e) {
            $payload['bing']['error'] = $e->getMessage();
            Log::warning('SEO/Bing error: '.$e->getMessage());
        }

        // Open PageRank
        try {
            $host = $this->getDomainHost();
            $rank = $opr->getPageRank($host);
            $payload['opr']['rank']      = $rank;
            $payload['opr']['connected'] = $rank !== null;
        } catch (\Throwable $e) {
            $payload['opr']['error'] = $e->getMessage();
            Log::warning('SEO/OPR error: '.$e->getMessage());
        }

        Cache::put('seo.metrics.latest', $payload, now()->addHours(6));

        return response()->json(['ok' => true, 'metrics' => $payload]);
    }

    /** JSON: résumé Bing (appel optionnel) */
    public function bingSummary(BingWebmasterClient $bing)
    {
        return response()->json($bing->summarizeLinkCounts());
    }

    /** JSON: PageRank pour le domaine courant (appel optionnel) */
    public function oprSummary(OpenPageRankClient $opr, Request $request)
    {
        $domain = $request->get('domain') ?: $this->getDomainHost();
        return response()->json(['domain' => $domain, 'rank' => $opr->getPageRank($domain)]);
    }

    /** JSON: pages à indexer (placeholder non bloquant) */
    public function pagesToIndex()
    {
        $metrics = Cache::get('seo.metrics.latest', []);
        return response()->json([
            'hint' => 'Connecte GSC pour une vraie liste',
            'from_cache' => (bool) $metrics,
        ]);
    }

    /** JSON: problèmes GSC (placeholder non bloquant) */
    public function gscIssues()
    {
        return response()->json(['connected' => false, 'issues' => []]);
    }

    /** JSON: backlinks (résumé basé sur cache) */
    public function backlinks()
    {
        $metrics = Cache::get('seo.metrics.latest', []);
        return response()->json([
            'connected' => (bool) ($metrics['bing']['connected'] ?? false),
            'summary'   => $metrics['bing']['summary'] ?? [],
            'note'      => 'Résumé basé sur cache Bing GetLinkCounts.',
        ]);
    }

    private function getDomainHost(): string
    {
        $url = config('seo.bing.site_url') ?: config('app.url');
        $host = parse_url($url, PHP_URL_HOST) ?: $url;
        return (string) $host;
    }
}

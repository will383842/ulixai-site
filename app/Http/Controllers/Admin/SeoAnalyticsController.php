<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Services\Seo\BingWebmasterClient;
use App\Services\Seo\OpenPageRankClient;
use App\Services\Analytics\GA4DataClient;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

        // Optionnel : tendance visiteurs GA4 (fail-safe : retourne [] si non configuré)
        try {
            $ga = new GA4DataClient();
            $visitorsTrend = $ga->activeUsersByDate(
                now()->subDays(29)->toDateString(),
                now()->toDateString()
            );
        } catch (\Throwable $e) {
            $visitorsTrend = [];
            Log::warning('SEO/GA4 trend error: ' . $e->getMessage());
        }

        return view('admin.seo-analytics.index', [
            'metrics'        => $metrics,
            'visitorsTrend'  => $visitorsTrend,
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
        try {
            return response()->json($bing->summarizeLinkCounts());
        } catch (\Throwable $e) {
            Log::warning('SEO/Bing summary error: '.$e->getMessage());
            return response()->json(['connected' => false, 'error' => $e->getMessage()], 200);
        }
    }

    /** JSON: PageRank pour le domaine courant (appel optionnel) */
    public function oprSummary(OpenPageRankClient $opr, Request $request)
    {
        try {
            $domain = $request->get('domain') ?: $this->getDomainHost();
            return response()->json(['domain' => $domain, 'rank' => $opr->getPageRank($domain)]);
        } catch (\Throwable $e) {
            Log::warning('SEO/OPR summary error: '.$e->getMessage());
            return response()->json(['domain' => null, 'rank' => null, 'error' => $e->getMessage()], 200);
        }
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

    /** Export CSV (visiteurs GA4) — non bloquant si GA4 inactif */
    public function export(Request $request)
    {
        $section = $request->get('section','visitors');
        $filename = "seo_export_{$section}_" . now()->format('Ymd_His') . ".csv";

        return new StreamedResponse(function () use ($section) {
            $out = fopen('php://output','w');

            if ($section === 'visitors') {
                try {
                    $ga = new GA4DataClient();
                    $data = $ga->activeUsersByDate(
                        now()->subDays(29)->toDateString(),
                        now()->toDateString()
                    );
                    fputcsv($out, ['date','active_users']);
                    foreach ($data as $d => $v) {
                        fputcsv($out, [$d, $v]);
                    }
                } catch (\Throwable $e) {
                    fputcsv($out, ['error', $e->getMessage()]);
                }
            } else {
                fputcsv($out, ['info','Section not supported']);
            }

            fclose($out);
        }, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    /** Domaine (host) à partir de la config */
    private function getDomainHost(): string
    {
        $url = config('seo.bing.site_url') ?: config('app.url');
        $host = parse_url($url, PHP_URL_HOST) ?: $url;
        return (string) $host;
    }
}

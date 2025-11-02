<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Services\Seo\BingWebmasterClient;
use App\Services\Seo\OpenPageRankClient;

class SeoAnalyticsController extends Controller
{
    public function index(Request $request)
    {
        // Try cache first
        $metrics = Cache::get('seo.metrics.latest');
        return view('admin.seo-analytics.index', [
            'metrics' => $metrics,
            'isConfigured' => [
                'bing' => (bool) (config('seo.bing.api_key') && config('seo.bing.site_url')),
                'opr'  => (bool) (config('seo.openpagerank.api_key')),
            ],
        ]);
    }

    public function refresh(Request $request, BingWebmasterClient $bing, OpenPageRankClient $opr)
    {
        // Trigger immediate refresh similar to console command
        $domain = parse_url(config('seo.bing.site_url') ?? config('app.url'), PHP_URL_HOST)
            ?: $request->getHost();
        $maxPages = (int) (config('seo.bing.max_pages', 5));

        $bingSummary = $bing->summarizeLinkCounts($maxPages);
        $oprData     = $opr->getPageRank($domain);

        $payload = [
            'generated_at' => now()->toIso8601String(),
            'domain'       => $domain,
            'bing'         => $bingSummary,
            'openpagerank' => $oprData,
        ];
        Cache::put('seo.metrics.latest', $payload, now()->addHours(6));

        return response()->json($payload);
    }

    // JSON endpoints if you want to fetch them individually from the UI
    public function bingSummary(BingWebmasterClient $bing)
    {
        return response()->json($bing->summarizeLinkCounts());
    }

    public function oprSummary(OpenPageRankClient $opr, Request $request)
    {
        $domain = $request->get('domain') ?: (parse_url(config('seo.bing.site_url') ?? config('app.url'), PHP_URL_HOST));
        return response()->json($opr->getPageRank($domain));
    }


    public function gscIssues(Request $request)
    {
        $site = config('seo.gsc.site_url');
        return response()->json([
            'connected' => !empty($site),
            'site_url'  => $site,
            'issues'    => [],
            'note'      => 'GSC non branché côté API; affichage statut uniquement.',
        ]);

    }


    public function pagesToIndex(Request $request)
    {
        return response()->json([
            'connected' => true,
            'items'     => [],
            'note'      => 'Logique de détection à implémenter (sitemap/queue/indexNow).',
        ]);

    }


    public function backlinks(Request $request)
    {
        $metrics = \Cache::get('seo.metrics.latest');
        return response()->json([
            'connected' => (bool) ($metrics['bing']['connected'] ?? false),
            'summary'   => $metrics['bing']['summary'] ?? [],
            'note'      => 'Résumé basé sur cache Bing GetLinkCounts.',
        ]);

    }
}

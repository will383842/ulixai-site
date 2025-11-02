<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BingWebmasterClient
{
    protected string $apiKey;
    protected ?string $siteUrl;
    protected string $baseUrl;
    protected int $maxPages;
    protected int $timeout;

    public function __construct()
    {
        $this->apiKey   = (string) (config('seo.bing.api_key') ?? '');
        $this->siteUrl  = config('seo.bing.site_url');
        $this->baseUrl  = rtrim((string) config('seo.bing.base_url', 'https://ssl.bing.com/webmaster/api.svc/json/'), '/').'/';
        $this->maxPages = (int) (config('seo.bing.max_pages', 3));
        $this->timeout  = (int) (config('seo.bing.timeout', 20));
    }

    /** Retourne un petit résumé pour l'UI; robuste si pas de clé. */
    public function summarizeLinkCounts(): array
    {
        if (!$this->apiKey || !$this->siteUrl) {
            return [
                'connected' => false,
                'summary' => [
                    'approxTotalLinks' => 0,
                    'scannedPages'     => 0,
                    'topPages'         => [],
                    'note'             => 'Clé API Bing/site URL manquante.',
                ]
            ];
        }

        // Bing Webmaster API: GetLinkCounts pour le site
        $totalLinks = 0;
        $page = 0;
        $topPages = [];

        try {
            for ($i = 0; $i < $this->maxPages; $i++) {
                $page++;
                $resp = Http::timeout($this->timeout)
                    ->withHeaders(['apikey' => $this->apiKey])
                    ->get($this->baseUrl.'GetLinkCounts', [
                        'siteUrl' => $this->siteUrl,
                        'page'    => $page,
                    ]);

                if (!$resp->ok()) break;

                $json = $resp->json();
                $items = data_get($json, 'd.results', []);
                if (empty($items)) break;

                foreach ($items as $row) {
                    $count = (int) ($row['Count'] ?? 0);
                    $url   = (string) ($row['Url'] ?? '');
                    $totalLinks += $count;
                    if ($url) {
                        $topPages[] = ['url' => $url, 'count' => $count];
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::warning('BingWebmasterClient error: '.$e->getMessage());
            return [
                'connected' => false,
                'summary' => [
                    'approxTotalLinks' => 0,
                    'scannedPages'     => $page,
                    'topPages'         => [],
                    'note'             => 'Erreur Bing: '.$e->getMessage(),
                ]
            ];
        }

        usort($topPages, fn($a,$b) => $b['count'] <=> $a['count']);
        $topPages = array_slice($topPages, 0, 10);

        return [
            'connected' => true,
            'summary' => [
                'approxTotalLinks' => $totalLinks,
                'scannedPages'     => $page,
                'topPages'         => $topPages,
                'note'             => 'Approximation basée sur Bing GetLinkCounts.',
            ]
        ];
    }
}

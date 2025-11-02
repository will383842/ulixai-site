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
        $cfg = config('seo.bing');
        $this->apiKey  = (string) ($cfg['api_key'] ?? '');
        $this->siteUrl = $cfg['site_url'] ?? null;
        $this->baseUrl = rtrim($cfg['base_url'] ?? 'https://ssl.bing.com/webmaster/api.svc/json/', '/') . '/';
        $this->maxPages = (int) ($cfg['max_pages'] ?? 5);
        $this->timeout  = (int) ($cfg['timeout'] ?? 20);
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->siteUrl);
    }

    protected function request(string $method, array $params)
    {
        if (!$this->isConfigured()) {
            return ['connected' => false, 'error' => 'missing_config'];
        }
        try {
            $url = $this->baseUrl . ltrim($method, '/');
            $resp = Http::timeout($this->timeout)
                ->retry(2, 500)
                ->acceptJson()
                ->get($url, array_merge($params, ['apikey' => $this->apiKey]));
            if (!$resp->ok()) {
                return ['connected' => false, 'error' => 'http_' . $resp->status()];
            }
            $json = $resp->json();
            return ['connected' => true, 'data' => $json['d'] ?? $json];
        } catch (\Throwable $e) {
            Log::warning('Bing API error: '.$e->getMessage());
            return ['connected' => false, 'error' => 'exception'];
        }
    }

    public function getLinkCounts(int $page = 0): array
    {
        return $this->request('GetLinkCounts', [
            'siteUrl' => $this->siteUrl,
            'page'    => $page,
        ]);
    }

    public function getUrlLinks(string $url, int $page = 0): array
    {
        return $this->request('GetUrlLinks', [
            'siteUrl' => $this->siteUrl,
            'url'     => $url,
            'page'    => $page,
        ]);
    }

    /**
     * Aggregate site-wide backlink counts based on GetLinkCounts pages.
     * This is an approximation of total inbound link counts across site pages.
     */
    public function summarizeLinkCounts(?int $limitPages = null): array
    {
        if (!$this->isConfigured()) {
            return ['connected' => false, 'summary' => []];
        }
        $limit = $limitPages ?? $this->maxPages;
        $page  = 0;
        $totalLinks = 0;
        $topPages = [];
        $totalPages = 1;
        do {
            $res = $this->getLinkCounts($page);
            if (!$res['connected']) {
                break;
            }
            $data = $res['data'] ?? [];
            $totalPages = (int) ($data['TotalPages'] ?? 1);
            foreach (($data['Links'] ?? []) as $link) {
                $count = (int) ($link['Count'] ?? 0);
                $url   = (string) ($link['Url'] ?? '');
                $totalLinks += $count;
                $topPages[] = ['url' => $url, 'count' => $count];
            }
            $page++;
        } while ($page < $totalPages && $page < $limit);

        // sort top pages desc by count and limit to 10
        usort($topPages, function ($a, $b) { return ($b['count'] <=> $a['count']); });
        $topPages = array_slice($topPages, 0, 10);

        return [
            'connected' => true,
            'summary' => [
                'approxTotalLinks' => $totalLinks,
                'scannedPages'     => $page,
                'topPages'         => $topPages,
                'note'             => 'Approximation based on Bing GetLinkCounts; may differ from other tools.',
            ]
        ];
    }
}

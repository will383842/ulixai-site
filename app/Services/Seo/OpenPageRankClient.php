<?php

namespace App\Services\Seo;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenPageRankClient
{
    protected string $apiKey;
    protected string $baseUrl;
    protected int $timeout;

    public function __construct()
    {
        $cfg = config('seo.openpagerank');
        $this->apiKey  = (string) ($cfg['api_key'] ?? '');
        $this->baseUrl = rtrim($cfg['base_url'] ?? 'https://openpagerank.com/api/v1.0/', '/') . '/';
        $this->timeout = (int) ($cfg['timeout'] ?? 15);
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    public function getPageRank(string $domain): array
    {
        if (!$this->isConfigured()) {
            return ['connected' => false, 'error' => 'missing_config'];
        }
        try {
            $resp = Http::timeout($this->timeout)
                ->retry(2, 500)
                ->withHeaders(['API-OPR' => $this->apiKey])
                ->acceptJson()
                ->get($this->baseUrl . 'getPageRank', ['domains' => [$domain]]);

            if (!$resp->ok()) {
                return ['connected' => false, 'error' => 'http_' . $resp->status()];
            }
            $json = $resp->json();
            $first = $json['response'][0] ?? null;
            if (!$first || ($first['status_code'] ?? 400) >= 400) {
                return ['connected' => true, 'data' => null];
            }
            return [
                'connected' => true,
                'data' => [
                    'domain'            => $first['domain'] ?? $domain,
                    'page_rank_decimal' => $first['page_rank_decimal'] ?? null,
                    'page_rank_integer' => $first['page_rank_integer'] ?? null,
                    'rank'              => $first['rank'] ?? null,
                ]
            ];
        } catch (\Throwable $e) {
            Log::warning('OPR API error: '.$e->getMessage());
            return ['connected' => false, 'error' => 'exception'];
        }
    }
}

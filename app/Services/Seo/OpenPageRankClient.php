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
        $this->apiKey  = (string) (config('seo.openpagerank.api_key') ?? '');
        $this->baseUrl = rtrim((string) config('seo.openpagerank.base_url', 'https://openpagerank.com/api/v1.0/'), '/').'/';
        $this->timeout = (int) (config('seo.openpagerank.timeout', 15));
    }

    /** Retourne un score de 0 à 10 (ou null si indispo) */
    public function getPageRank(string $domain): ?float
    {
        if (!$this->apiKey || !$domain) {
            return null;
        }
        try {
            $resp = Http::timeout($this->timeout)
                ->withHeaders(['API-OPR' => $this->apiKey])
                ->get($this->baseUrl.'getPageRank', ['domains' => $domain]);

            if (!$resp->ok()) return null;
            $json = $resp->json();
            $data = data_get($json, 'response.0', []);
            $rank = data_get($data, 'rank', null);
            return $rank !== null ? (float) $rank : null;
        } catch (\Throwable $e) {
            Log::warning('OpenPageRankClient error: '.$e->getMessage());
            return null;
        }
    }
}

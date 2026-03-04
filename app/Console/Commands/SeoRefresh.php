<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Services\Seo\BingWebmasterClient;
use App\Services\Seo\OpenPageRankClient;

class SeoRefresh extends Command
{
    protected $signature = 'seo:refresh {--domain=} {--max-pages=}';
    protected $description = 'Fetch SEO metrics from Bing Webmaster API and OpenPageRank API, cache and persist JSON snapshot.';

    public function handle(BingWebmasterClient $bing, OpenPageRankClient $opr)
    {
        $this->info('Refreshing SEO metrics...');

        $domain = $this->option('domain');
        if (!$domain) {
            // fallback to parse domain from BING_SITE_URL or app.url
            $siteUrl = config('seo.bing.site_url') ?? config('app.url');
            $domain = parse_url($siteUrl, PHP_URL_HOST) ?: $siteUrl;
        }

        $maxPages = (int) ($this->option('max-pages') ?? config('seo.bing.max_pages', 5));

        $bingSummary = $bing->summarizeLinkCounts($maxPages);
        $oprData     = $opr->getPageRank($domain);

        $payload = [
            'generated_at' => now()->toIso8601String(),
            'domain'       => $domain,
            'bing'         => $bingSummary,
            'openpagerank' => $oprData,
        ];

        // cache
        Cache::put('seo.metrics.latest', $payload, now()->addHours(6));

        // persist daily snapshot
        $path = 'seo-metrics/' . now()->format('Y-m-d') . '.json';
        Storage::disk('local')->put($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $this->info('Done: cached latest metrics and wrote storage/app/' . $path);

        return self::SUCCESS;
    }
}

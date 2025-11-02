<?php

namespace App\Services\Analytics;

use Google\Client as GoogleClient;
use Google\Service\AnalyticsData;
use Google\Service\AnalyticsData\DateRange;
use Google\Service\AnalyticsData\Dimension;
use Google\Service\AnalyticsData\Metric;
use Google\Service\AnalyticsData\RunReportRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * GA4 client "fail-safe":
 * - Ne jette jamais d'exception si config manquante/incorrecte
 * - Retourne []/null et log un warning
 * - Accepte un ID numérique (ajoute "properties/" automatiquement)
 */
class GA4DataClient
{
    protected ?AnalyticsData $service = null;
    protected ?string $propertyId = null;

    public function __construct()
    {
        $prop = (string) (config('analytics.ga4.property_id') ?? '');
        if ($prop && strpos($prop, 'properties/') !== 0) {
            // Permet d'écrire 510947242 dans .env : on préfixe automatiquement
            $prop = 'properties/' . $prop;
        }
        $this->propertyId = $prop ?: null;

        try {
            if (!$this->propertyId) {
                Log::warning('GA4 disabled: missing property id');
                return; // Désactivé proprement
            }

            $client = new GoogleClient();

            $saJson = config('analytics.ga4.service_account_json');
            $saPath = config('analytics.ga4.service_account_json_path');

            if ($saJson) {
                $client->setAuthConfig(json_decode($saJson, true));
            } elseif ($saPath) {
                $client->setAuthConfig($saPath);
            } elseif (getenv('GOOGLE_APPLICATION_CREDENTIALS')) {
                $client->useApplicationDefaultCredentials();
            } else {
                Log::warning('GA4 disabled: missing service account credentials');
                return; // Désactivé proprement
            }

            $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
            $this->service = new AnalyticsData($client);
        } catch (\Throwable $e) {
            Log::warning('GA4 init failed: ' . $e->getMessage());
            $this->service = null; // Désactivé
        }
    }

    /**
     * Retourne un tableau "YYYY-MM-DD" => activeUsers pour une période.
     */
    public function activeUsersByDate(string $startDate, string $endDate): array
    {
        try {
            if (!$this->service || !$this->propertyId) {
                return [];
            }

            $cacheKey = "ga4.activeUsers.$startDate.$endDate";

            return Cache::remember($cacheKey, now()->addHours(6), function () use ($startDate, $endDate) {
                $req = new RunReportRequest();
                $req->setDateRanges([new DateRange(['startDate' => $startDate, 'endDate' => $endDate])]);
                $req->setDimensions([new Dimension(['name' => 'date'])]);
                $req->setMetrics([new Metric(['name' => 'activeUsers'])]);

                $res = $this->service->properties->runReport($this->propertyId, $req);
                $out = [];
                foreach ($res->getRows() ?? [] as $row) {
                    $d = $row->getDimensionValues()[0]->getValue(); // YYYYMMDD
                    $v = (int) $row->getMetricValues()[0]->getValue();
                    $out[substr($d, 0, 4) . '-' . substr($d, 4, 2) . '-' . substr($d, 6, 2)] = $v;
                }
                return $out;
            });
        } catch (\Throwable $e) {
            Log::warning('GA4 activeUsersByDate failed: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Somme des visiteurs actifs depuis le début du mois.
     */
    public function visitorsThisMonth(): ?int
    {
        $arr = $this->activeUsersByDate(
            now()->startOfMonth()->toDateString(),
            now()->toDateString()
        );
        return $arr ? array_sum($arr) : null;
    }
}

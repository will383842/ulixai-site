<?php

namespace App\Services\Analytics;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Lightweight GA4 client (fail-safe).
 * Returns null if not configured. Safe to call in production.
 */
class GoogleAnalyticsClient
{
    public function visitorsThisMonth(): ?int
    {
        try {
            $propertyId = (string) (config('analytics.ga4.property_id') ?? '');
            if (!$propertyId) {
                return null;
            }
            // TODO: Implement GA4 Data API call with service account if desired.
            return null;
        } catch (\Throwable $e) {
            Log::warning('GA4 visitorsThisMonth failed: '.$e->getMessage());
            return null;
        }
    }
}

<?php

namespace App\Services;

use App\Models\Mission;
use App\Models\ServiceProvider;
use Illuminate\Support\Str;

class ProviderMatcher
{
    private const W = [
        'language'       => 0.30,
        'location'       => 0.25,
        'category'       => 0.20,
        'reputation'     => 0.10,
        'responsiveness' => 0.05,
        'availability'   => 0.05,
        'tenure'         => 0.05,
    ];

    public static function topForMission(Mission $mission, int $limit = 10)
    {
        $providers = ServiceProvider::query()
            ->with(['reviews:id,provider_id,rating', 'user:id,email,created_at'])
            ->where('provider_visibility', true)
            ->get();

        $lang        = strtolower(trim((string) $mission->language));
        $mCity       = strtolower(trim((string) $mission->location_city));
        $mCountry    = strtolower(trim((string) $mission->location_country));
        $catId       = (int) ($mission->category_id ?? 0);
        $subcatId    = (int) ($mission->subcategory_id ?? 0);
        $subsubcatId = (int) ($mission->subsubcategory_id ?? 0);

        $scored = $providers->map(function (ServiceProvider $p) use ($lang, $mCity, $mCountry, $catId, $subcatId, $subsubcatId) {
            $scores = [
                'language'       => self::scoreLanguage($p, $lang),
                'location'       => self::scoreLocation($p, $mCity, $mCountry),
                'category'       => self::scoreCategory($p, $catId, $subcatId),
                'reputation'     => self::scoreReputation($p),
                'responsiveness' => self::scoreResponsiveness($p),
                'availability'   => self::scoreAvailability($p),
                'tenure'         => self::scoreTenure($p),
            ];

            $total = 0.0;
            foreach (self::W as $k => $w) {
                $total += $w * ($scores[$k] ?? 0.0);
            }

            $p->match_breakdown = $scores;
            $p->match_score = round($total, 4);

            return $p;
        })
        ->sortByDesc('match_score')
        ->take($limit)
        ->values();

        return $scored;
    }

    private static function scoreLanguage(ServiceProvider $p, string $lang): float
    {
        if ($lang === '') return 0.5;

        $spoken = array_map('strtolower', (array) $p->spoken_language);
        $native = strtolower((string) $p->native_language);
        $pref   = strtolower((string) $p->preferred_language);

        if (in_array($lang, $spoken, true)) return 1.0;
        if ($lang === $native || $lang === $pref) return 0.7;
        return 0.0;
    }

    private static function scoreLocation(ServiceProvider $p, string $mCity, string $mCountry): float
    {
        $pCountry    = strtolower((string) $p->provider_address);

        if ($mCountry && Str::contains($pCountry, $mCountry)) return 1.0;
        return 0.0;
    }

    private static function scoreCategory(ServiceProvider $p, int $catId, int $subcatId): float
    {
        $cat = array_map('intval', (array) $p->services_to_offer);
        $subcat = array_map('intval', (array) $p->services_to_offer_category);

        $main = $catId ? in_array($catId, $cat, true) : false;
        $sub  = $subcatId ? in_array($subcatId, $subcat, true) : false;
        if ($main && $sub) return 1.0;
        if ($main || $sub) return 0.7;
        return 0.0;
    }

    private static function scoreReputation(ServiceProvider $p): float
    {
        $avg   = (float) ($p->reviews->avg('rating') ?? 0.0); 
        $count = (int) $p->reviews->count();

        $ratingScore = $avg > 0 ? min(1.0, $avg / 5.0) : 0.0;
        $volumeBoost = min(1.0, ($count > 0) ? (log($count + 1) / log(20)) : 0.0);

        return round(0.8 * $ratingScore + 0.2 * $volumeBoost, 4); 
    }

    private static function scoreResponsiveness(ServiceProvider $p): float
    {
        return 0.5;
    }

    private static function scoreAvailability(ServiceProvider $p): float
    {
        return $p->provider_visibility ? 1.0 : 0.0;
    }

    private static function scoreTenure(ServiceProvider $p): float
    {
        $months = now()->diffInMonths($p->created_at ?? now());
        return min(1.0, $months / 24.0);
    }
}

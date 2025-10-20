<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class GeolocationService
{
    private const CACHE_TTL = 3600; // 1 hour
    private const API_TIMEOUT = 5;

    /**
     * Get user's country from their IP address
     */
    public function getCountryFromRequest(Request $request): ?string
    {
        $ip = $this->getRealClientIp($request);
        
        if (!$ip) {
            Log::info('Could not determine client IP');
            return null;
        }

        return $this->getCountryFromIp($ip);
    }

    /**
     * Get country from IP address with caching
     */
    public function getCountryFromIp(string $ip): ?string
    {
        // Skip if local/private IP
        if (!$this->isPublicIp($ip)) {
            Log::info('Private/local IP detected: ' . $ip);
            return $this->getTestCountry();
        }

        // Check cache first
        $cacheKey = "country_ip_{$ip}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $country = $this->fetchCountryFromApi($ip);
        
        // Cache the result (even if null to avoid repeated API calls)
        Cache::put($cacheKey, $country, self::CACHE_TTL);
        
        return $country;
    }

    /**
     * Get real client IP from request headers
     */
    private function getRealClientIp(Request $request): ?string
    {
        $headers = [
            'HTTP_CF_CONNECTING_IP',     // Cloudflare
            'HTTP_X_FORWARDED_FOR',      // Load balancer/proxy
            'HTTP_X_REAL_IP',            // Nginx proxy
            'HTTP_X_FORWARDED',          // Proxy
            'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
            'HTTP_CLIENT_IP',            // Proxy
            'HTTP_FORWARDED_FOR',        // Proxy
            'HTTP_FORWARDED',            // Proxy
        ];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ips = explode(',', $_SERVER[$header]);
                $ip = trim($ips[0]);
                
                if ($this->isValidIp($ip)) {
                    return $ip;
                }
            }
        }

        return $request->ip();
    }

    /**
     * Fetch country from IP geolocation API
     */
    private function fetchCountryFromApi(string $ip): ?string
    {
        try {
            $response = Http::timeout(self::API_TIMEOUT)
                ->get("https://ip-api.com/json/{$ip}?fields=status,country,message");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['status'] === 'success') {
                    Log::info("Country detected for IP {$ip}: " . $data['country']);
                    return $data['country'];
                } else {
                    Log::warning("IP geolocation failed for {$ip}: " . ($data['message'] ?? 'Unknown error'));
                }
            } else {
                Log::error("IP API request failed for {$ip}: HTTP " . $response->status());
            }
        } catch (\Throwable $e) {
            Log::error("IP lookup exception for {$ip}: " . $e->getMessage());
        }

        return null;
    }

    /**
     * Check if IP is valid and public
     */
    private function isValidIp(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }

    /**
     * Check if IP is public (not private/local)
     */
    private function isPublicIp(string $ip): bool
    {
        return $this->isValidIp($ip);
    }

    /**
     * Get test country for local development
     */
    private function getTestCountry(): ?string
    {
        if (app()->environment('local')) {
            // You can return a test country for local development
            return config('app.test_country', 'United States');
        }
        
        return null;
    }

    /**
     * Get detailed location info from IP
     */
    public function getLocationFromIp(string $ip): ?array
    {
        if (!$this->isPublicIp($ip)) {
            return null;
        }

        $cacheKey = "location_ip_{$ip}";
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        try {
            $response = Http::timeout(self::API_TIMEOUT)
                ->get("https://ip-api.com/json/{$ip}?fields=status,country,countryCode,region,regionName,city,timezone,message");
            
            if ($response->successful()) {
                $data = $response->json();
                
                if ($data['status'] === 'success') {
                    $location = [
                        'country' => $data['country'],
                        'country_code' => $data['countryCode'],
                        'region' => $data['regionName'],
                        'city' => $data['city'],
                        'timezone' => $data['timezone'],
                    ];
                    
                    Cache::put($cacheKey, $location, self::CACHE_TTL);
                    return $location;
                }
            }
        } catch (\Throwable $e) {
            Log::error("Location lookup failed for {$ip}: " . $e->getMessage());
        }

        return null;
    }
}
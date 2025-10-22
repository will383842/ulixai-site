<?php

/**
 * SLUG GENERATOR - Perfect SEO Structure
 * 
 * Generate SEO-friendly slugs for provider profiles
 * Format: [firstname]-[lastname]-[service]-[location]
 * 
 * Example: marie-dupont-relocation-helper-bangkok
 */

namespace App\Helpers;

use App\Models\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Str;

class SlugGenerator
{
    /**
     * Generate perfect SEO slug for provider
     * 
     * @param ServiceProvider $provider
     * @return string
     */
    public static function generateProviderSlug($provider)
    {
        // Get main service (first service from array)
        $mainService = self::getMainService($provider);
        
        // Get location (provider_address or country)
        $location = self::getLocation($provider);
        
        // Build slug parts
        $parts = [
            $provider->first_name,
            $provider->last_name,
            $mainService ?? 'helper',  // Default to 'helper' if no service
            $location
        ];
        
        // Clean and join parts
        $slug = self::cleanAndJoin($parts);
        
        // Ensure uniqueness
        $slug = self::ensureUnique($slug, $provider->id ?? null);
        
        return $slug;
    }
    
    /**
     * Get main service from provider
     * 
     * @param ServiceProvider $provider
     * @return string|null
     */
    private static function getMainService($provider)
    {
        if (!$provider->services_to_offer) {
            return null;
        }
        
        // Decode JSON if string
        $services = is_string($provider->services_to_offer) 
            ? json_decode($provider->services_to_offer, true) 
            : $provider->services_to_offer;
        
        if (empty($services) || !is_array($services)) {
            return null;
        }
        
        // Get first service
        $serviceId = $services[0];
        
        // Find category
        $category = Category::find($serviceId);
        
        if (!$category) {
            return null;
        }
        
        // Return cleaned category name
        return self::cleanString($category->name);
    }
    
    /**
     * Get location from provider
     * 
     * @param ServiceProvider $provider
     * @return string|null
     */
    private static function getLocation($provider)
    {
        $location = $provider->provider_address ?? $provider->country ?? null;
        
        if (!$location) {
            return null;
        }
        
        return self::cleanString($location);
    }
    
    /**
     * Clean a string for slug
     * 
     * @param string $string
     * @return string
     */
    private static function cleanString($string)
    {
        if (!$string) {
            return '';
        }
        
        // Remove accents
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        
        // Lowercase
        $string = strtolower($string);
        
        // Remove special characters, keep only alphanumeric and spaces
        $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
        
        // Replace spaces and multiple dashes with single dash
        $string = preg_replace('/[\s-]+/', '-', $string);
        
        // Trim dashes from start and end
        $string = trim($string, '-');
        
        return $string;
    }
    
    /**
     * Clean and join slug parts
     * 
     * @param array $parts
     * @return string
     */
    private static function cleanAndJoin($parts)
    {
        return collect($parts)
            ->filter()  // Remove empty parts
            ->map(function($part) {
                return self::cleanString($part);
            })
            ->filter()  // Remove empty cleaned parts
            ->join('-');
    }
    
    /**
     * Ensure slug is unique
     * 
     * @param string $slug
     * @param int|null $currentProviderId
     * @return string
     */
    private static function ensureUnique($slug, $currentProviderId = null)
    {
        $originalSlug = $slug;
        $counter = 1;
        
        while (self::slugExists($slug, $currentProviderId)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    /**
     * Check if slug exists
     * 
     * @param string $slug
     * @param int|null $currentProviderId
     * @return bool
     */
    private static function slugExists($slug, $currentProviderId = null)
    {
        $query = ServiceProvider::where('slug', $slug);
        
        // Exclude current provider if updating
        if ($currentProviderId) {
            $query->where('id', '!=', $currentProviderId);
        }
        
        return $query->exists();
    }
    
    /**
     * Alternative: Generate shorter slug
     * Format: [firstname]-[lastname]-helper-[location]
     * 
     * @param ServiceProvider $provider
     * @return string
     */
    public static function generateShortSlug($provider)
    {
        $location = self::getLocation($provider);
        
        $parts = [
            $provider->first_name,
            $provider->last_name,
            'helper',
            $location
        ];
        
        $slug = self::cleanAndJoin($parts);
        $slug = self::ensureUnique($slug, $provider->id ?? null);
        
        return $slug;
    }
}

/**
 * USAGE EXAMPLES:
 * 
 * 1. Creating new provider:
 * 
 * $provider = new ServiceProvider();
 * $provider->first_name = "Marie";
 * $provider->last_name = "Dupont";
 * $provider->services_to_offer = json_encode([668]); // Relocation service
 * $provider->provider_address = "Bangkok";
 * $provider->slug = SlugGenerator::generateProviderSlug($provider);
 * $provider->save();
 * 
 * Result: marie-dupont-relocation-helper-bangkok
 * 
 * 
 * 2. Updating existing provider:
 * 
 * $provider = ServiceProvider::find(324);
 * $provider->slug = SlugGenerator::generateProviderSlug($provider);
 * $provider->save();
 * 
 * 
 * 3. In controller on registration:
 * 
 * use App\Helpers\SlugGenerator;
 * 
 * public function store(Request $request)
 * {
 *     $provider = new ServiceProvider($request->all());
 *     $provider->slug = SlugGenerator::generateProviderSlug($provider);
 *     $provider->save();
 *     
 *     return redirect()->route('provider.profile', ['slug' => $provider->slug]);
 * }
 * 
 * 
 * 4. Using Model Observer (automatic):
 * 
 * // app/Observers/ServiceProviderObserver.php
 * 
 * class ServiceProviderObserver
 * {
 *     public function creating(ServiceProvider $provider)
 *     {
 *         if (!$provider->slug) {
 *             $provider->slug = SlugGenerator::generateProviderSlug($provider);
 *         }
 *     }
 *     
 *     public function updating(ServiceProvider $provider)
 *     {
 *         // Optionally regenerate if name/service changed
 *         if ($provider->isDirty(['first_name', 'last_name', 'services_to_offer'])) {
 *             $provider->slug = SlugGenerator::generateProviderSlug($provider);
 *         }
 *     }
 * }
 * 
 * // Register in AppServiceProvider:
 * ServiceProvider::observe(ServiceProviderObserver::class);
 * 
 * 
 * 5. Batch update existing providers:
 * 
 * use App\Helpers\SlugGenerator;
 * 
 * ServiceProvider::chunk(100, function ($providers) {
 *     foreach ($providers as $provider) {
 *         $provider->slug = SlugGenerator::generateProviderSlug($provider);
 *         $provider->save();
 *     }
 * });
 */
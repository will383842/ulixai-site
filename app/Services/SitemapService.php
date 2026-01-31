<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class SitemapService
{
    public function buildIndex(): string
    {
        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap><loc>https://ulixai.com/sitemap.xml</loc></sitemap>
  <sitemap><loc>https://ulixai.com/sitemap-providers.xml</loc></sitemap>
  <sitemap><loc>https://blog.ulixai.com/sitemap_index.xml</loc></sitemap>
</sitemapindex>
XML;
        return $xml;
    }

    public function buildStatic(): string
    {
        return Cache::remember('sitemap.static', 3600, function () {
            $now = now()->toAtomString();
            $urls = [
                ['loc' => 'https://ulixai.com/',                        'priority' => '1.0'],
                ['loc' => 'https://ulixai.com/become-service-provider', 'priority' => '0.8'],
                ['loc' => 'https://ulixai.com/service-providers',       'priority' => '0.8'],
                ['loc' => 'https://ulixai.com/recruitment',             'priority' => '0.7'],
                ['loc' => 'https://ulixai.com/partnerships',            'priority' => '0.7'],
                ['loc' => 'https://ulixai.com/affiliate',               'priority' => '0.7'],
                ['loc' => 'https://ulixai.com/affiliate/sign-up',       'priority' => '0.6'],
                ['loc' => 'https://ulixai.com/customerreviews',         'priority' => '0.6'],
                ['loc' => 'https://ulixai.com/aboutUS',                 'priority' => '0.5'],
                ['loc' => 'https://ulixai.com/press',                   'priority' => '0.5'],
                ['loc' => 'https://ulixai.com/cookiemanagment',         'priority' => '0.5'],
            ];

            $body = '';
            foreach ($urls as $u) {
                $loc = htmlspecialchars($u['loc'], ENT_XML1);
                $lastmod = htmlspecialchars($now, ENT_XML1);
                $priority = htmlspecialchars($u['priority'], ENT_XML1);
                $body .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod><changefreq>weekly</changefreq><priority>{$priority}</priority></url>";
            }

            return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">{$body}</urlset>";
        });
    }

    public function buildProviders(): string
    {
        return Cache::remember('sitemap.providers', 3600, function () {
            $table = 'service_providers';

            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'slug')) {
                return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"></urlset>";
            }

            $q = DB::table($table)->select(['slug', 'updated_at']);

            // Filtrer les prestataires visibles et actifs
            if (Schema::hasColumn($table, 'provider_visibility')) {
                $q->where('provider_visibility', 1);
            }
            if (Schema::hasColumn($table, 'is_active')) {
                $q->where('is_active', 1);
            }
            // Exclure les soft deleted
            if (Schema::hasColumn($table, 'deleted_at')) {
                $q->whereNull('deleted_at');
            }
            // Exclure les slugs vides
            $q->whereNotNull('slug')->where('slug', '!=', '');

            $q->orderBy('id');

            $body = '';
            $q->chunk(1000, function ($rows) use (&$body) {
                foreach ($rows as $r) {
                    $slug = $r->slug;
                    $updated = $r->updated_at;

                    $loc = htmlspecialchars(url('/provider/'.$slug), ENT_XML1);
                    $lastmod = $updated ? Carbon::parse($updated)->toAtomString() : now()->toAtomString();
                    $body .= "<url><loc>{$loc}</loc><lastmod>{$lastmod}</lastmod><changefreq>daily</changefreq><priority>0.7</priority></url>";
                }
            });

            return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">{$body}</urlset>";
        });
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;

class SitemapTest extends TestCase
{
    /** @test */
    public function it_serves_sitemap_index()
    {
        $res = $this->get('/sitemap_index.xml');
        $res->assertStatus(200);
        $res->assertHeader('Content-Type', 'application/xml');
        $res->assertSee('<sitemapindex', false);
        $res->assertSee('sitemap.xml', false);
    }

    /** @test */
    public function it_serves_static_sitemap()
    {
        $res = $this->get('/sitemap.xml');
        $res->assertStatus(200);
        $res->assertHeader('Content-Type', 'application/xml');
        $res->assertSee('<urlset', false);
        $res->assertSee('https://ulixai.com/', false);
    }

    /** @test */
    public function it_serves_providers_sitemap()
    {
        $res = $this->get('/sitemap-providers.xml');
        $res->assertStatus(200);
        $res->assertHeader('Content-Type', 'application/xml');
        $res->assertSee('<urlset', false);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\SitemapService;

class SitemapController extends Controller
{
    public function __construct(private SitemapService $sitemaps) {}

    public function index(): Response
    {
        return response($this->sitemaps->buildIndex(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    public function static(): Response
    {
        return response($this->sitemaps->buildStatic(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    public function providers(): Response
    {
        return response($this->sitemaps->buildProviders(), 200)
            ->header('Content-Type', 'application/xml')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}

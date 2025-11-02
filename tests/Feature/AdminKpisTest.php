<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminKpisTest extends TestCase
{
    /** @test */
    public function admin_dashboard_route_exists()
    {
        $response = $this->get('/admin/dashboard');
        $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
    }

    /** @test */
    public function accounting_page_renders()
    {
        $response = $this->get('/admin/accounting');
        $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
    }

    /** @test */
    public function seo_export_endpoint_exists()
    {
        $response = $this->get('/admin/seo/export?section=visitors');
        $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
    }

    /** @test */
    public function accounting_export_endpoint_exists()
    {
        $response = $this->get('/admin/accounting/export?section=revenue');
        $this->assertTrue(in_array($response->getStatusCode(), [200, 302]));
    }
}

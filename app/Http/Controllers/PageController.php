<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function show($slug = 'index')
    {
        // Convert slugs like "about-us" to "aboutus"
        $slug = str_replace('-', '', $slug);

        // Try pages.{slug} first
        $viewPath = 'pages.' . $slug;
        if (View::exists($viewPath)) {
            $user = auth()->user();
            return view($viewPath, compact('user'));
        }

        // Try dashboard.{slug} if not found in pages
        $dashboardViewPath = 'dashboard.' . $slug;
        if (View::exists($dashboardViewPath)) {
            $user = auth()->user();
            return view($dashboardViewPath, compact('user'));
        }
        abort(404);
    }
}

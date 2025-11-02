<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    /**
     * Admin messages index.
     * If MESSAGES_ADMIN_URL (or services.messages_admin.url) is set, redirect there.
     * Otherwise render a small placeholder view.
     */
    public function index(Request $request)
    {
        $url = config('services.messages_admin.url') ?? env('MESSAGES_ADMIN_URL');
        if (!empty($url)) {
            // 302 to external tool (no dependency kept here)
            return redirect()->away($url);
        }
        return view('admin.messages.index');
    }

    /**
     * Keep JSON shape for compatibility with any existing fetch in the admin view.
     */
    public function list(Request $request)
    {
        return response()->json([
            'data' => [],
            'meta' => ['total' => 0],
        ]);
    }

    /**
     * No-op toggle: return ok to avoid breaking any checkbox handler.
     */
    public function toggle(Request $request)
    {
        return response()->json(['ok' => true]);
    }
}

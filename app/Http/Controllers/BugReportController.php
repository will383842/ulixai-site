<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BugReport;
use Illuminate\Support\Facades\Auth;

class BugReportController extends Controller
{
    /**
     * Store a new bug report (API endpoint)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bug_description' => 'nullable|string|max:2000',
            'suggestions' => 'nullable|string|max:2000',
            'report_type' => 'required|in:bug,suggestion,question,other',
            'priority' => 'nullable|in:low,medium,high,critical',
            'page_url' => 'nullable|string|max:500',
            'screen_size' => 'nullable|string|max:50',
        ]);

        // At least one field must be filled
        if (empty($validated['bug_description']) && empty($validated['suggestions'])) {
            return response()->json([
                'message' => 'Please provide a description or suggestion.',
                'errors' => ['bug_description' => ['Please describe the issue or suggestion.']]
            ], 422);
        }

        BugReport::create([
            'user_id' => Auth::id(), // null if guest
            'country' => $this->detectCountry($request),
            'language' => $request->getPreferredLanguage(['en', 'fr', 'es', 'de', 'it', 'pt']) ?? 'en',
            'bug_description' => $validated['bug_description'] ?? null,
            'suggestions' => $validated['suggestions'] ?? null,
            'page_url' => $validated['page_url'] ?? $request->headers->get('referer'),
            'user_agent' => $request->userAgent(),
            'screen_size' => $validated['screen_size'] ?? null,
            'priority' => $validated['priority'] ?? 'medium',
            'status' => 'pending',
            'report_type' => $validated['report_type'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your report has been submitted successfully.'
        ]);
    }

    /**
     * Detect user country from IP (simplified)
     */
    private function detectCountry(Request $request): ?string
    {
        // Use GeoIP if available, otherwise return null
        // This is a placeholder - you can integrate with a GeoIP service
        return null;
    }

}

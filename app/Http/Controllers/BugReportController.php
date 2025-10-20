<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BugReport;

class BugReportController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id', // Add validation for user_id
            'country' => 'nullable|string|max:100',
            'language' => 'nullable|string|max:100',
            'bug_description' => 'nullable|string|max:2000',
            'suggestions' => 'nullable|string|max:2000',
        ]);

        BugReport::create([
            'user_id' => $validated['user_id'], // Use the validated user_id from request
            'country' => $validated['country'],
            'language' => $validated['language'],
            'bug_description' => $validated['bug_description'],
            'suggestions' => $validated['suggestions'],
        ]);

        return response()->json(['message' => 'Bug report submitted successfully.']);
    }
}
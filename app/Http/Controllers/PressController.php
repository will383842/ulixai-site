<?php

namespace App\Http\Controllers;

use App\Models\Press;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PressController extends Controller
{
    /**
     * Display press page (public)
     */
    public function index($locale = 'en')
    {
        // Get all press items, ordered by most recent
        $pressItems = Press::orderBy('updated_at', 'desc')->get();
        
        return view('press.index', [
            'pressItems' => $pressItems,
            'locale' => $locale,
            'showContent' => true, // For document #3
        ]);
    }

    /**
     * Serve a press asset (download/view)
     */
    public function asset($id, $type)
    {
        $press = Press::findOrFail($id);
        
        // Validate type
        if (!in_array($type, ['icon', 'photo', 'pdf', 'guideline_pdf'])) {
            abort(404);
        }
        
        $filePath = $press->$type;
        
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        
        // Return file for download/viewing
        return response()->file(storage_path('app/public/' . $filePath));
    }

    /**
     * Preview a press asset (for iframe viewing)
     */
    public function preview($id, $type)
    {
        $press = Press::findOrFail($id);
        
        if (!in_array($type, ['icon', 'photo', 'pdf', 'guideline_pdf'])) {
            abort(404);
        }
        
        $filePath = $press->$type;
        
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        
        $fullPath = storage_path('app/public/' . $filePath);
        $mimeType = mime_content_type($fullPath);
        
        return response()->file($fullPath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline', // Display in browser instead of download
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Press;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PressController extends Controller
{
    /**
     * Display press page (public) - Main hub with language selector
     */
    public function index($locale = 'en')
    {
        // Get all press items for this language only
        $pressItems = Press::where('language', $locale)
                          ->orderBy('updated_at', 'desc')
                          ->get();
        
        return view('press.index', [
            'pressItems' => $pressItems,
            'locale' => $locale,
            'showContent' => true,
        ]);
    }

    /**
     * Store a new press item (ADMIN)
     * Creates one item per language with all 4 file types
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'language' => 'required|in:en,fr,de',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:20480',
            'guideline_pdf' => 'nullable|file|mimes:pdf|max:20480',
            'photo' => 'nullable|file|mimes:png,jpg,jpeg,webp|max:10240',
        ]);

        // Find or create ONE item per language (not per type!)
        $press = Press::where('language', $validated['language'])->first();
        
        if (!$press) {
            $press = new Press();
            $press->language = $validated['language'];
        }

        $press->title = $validated['title'] ?? $press->title;
        $press->description = $validated['description'] ?? $press->description;

        // Handle file uploads
        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($press->{$field} && Storage::disk('public')->exists($press->{$field})) {
                    Storage::disk('public')->delete($press->{$field});
                }
                // Store new file
                $press->{$field} = $request->file($field)->store('press', 'public');
            }
        }

        $press->save();

        return response()->json([
            'success' => true,
            'message' => 'Press item created successfully'
        ]);
    }

    /**
     * Upload a single file for a press item (AJAX - ADMIN)
     * ✅ CORRECTED: Only one item per language
     */
    public function upload(Request $request)
    {
        try {
            $validated = $request->validate([
                'file' => 'required|file|max:20480',
                'type' => 'required|in:icon,pdf,guideline_pdf,photo',
                'language' => 'required|in:en,fr,de',
            ]);

            // ✅ CORRECTED: Get ONE item per language
            $press = Press::where('language', $validated['language'])->first();

            if (!$press) {
                $press = new Press();
                $press->language = $validated['language'];
                $press->title = null;
                $press->description = null;
            }

            $fieldName = $validated['type'];

            // Delete old file if exists
            if ($press->{$fieldName} && Storage::disk('public')->exists($press->{$fieldName})) {
                Storage::disk('public')->delete($press->{$fieldName});
            }

            // Store new file
            $path = $request->file('file')->store('press', 'public');
            $press->{$fieldName} = $path;
            $press->save();

            return response()->json([
                'success' => true,
                'message' => 'Fichier uploadé avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete a specific file from a press item (AJAX - ADMIN)
     * ✅ CORRECTED: Only one item per language
     */
    public function delete(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:icon,pdf,guideline_pdf,photo',
                'language' => 'required|in:en,fr,de',
            ]);

            // ✅ CORRECTED: Get ONE item per language
            $press = Press::where('language', $validated['language'])->first();

            if (!$press) {
                return response()->json([
                    'success' => false,
                    'message' => 'Fichier non trouvé'
                ], 404);
            }

            $fieldName = $validated['type'];

            // Delete file from storage
            if ($press->{$fieldName} && Storage::disk('public')->exists($press->{$fieldName})) {
                Storage::disk('public')->delete($press->{$fieldName});
            }

            // Set field to null instead of deleting the item
            $press->{$fieldName} = null;
            $press->save();

            return response()->json([
                'success' => true,
                'message' => 'Fichier supprimé'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get existing files for a language (AJAX - ADMIN)
     */
    public function getFiles(Request $request)
    {
        $language = $request->query('language', 'en');

        $press = Press::where('language', $language)->first();

        if (!$press) {
            return response()->json([
                'success' => true,
                'files' => []
            ]);
        }

        $files = [];
        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $type) {
            if (!empty($press->{$type})) {
                $files[$type] = [
                    'id' => $press->id,
                    'name' => $press->title ?? 'Sans titre'
                ];
            }
        }

        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }

    /**
     * Destroy a single press entry (ADMIN)
     */
    public function destroy($id)
    {
        try {
            $press = Press::findOrFail($id);

            // Delete all associated files
            foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
                if ($press->$field && Storage::disk('public')->exists($press->$field)) {
                    Storage::disk('public')->delete($press->$field);
                }
            }

            $press->delete();

            return redirect()->back()->with('success', '✅ Fichier supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Delete all press items (ADMIN)
     */
    public function deleteAll()
    {
        $items = Press::all();

        foreach ($items as $item) {
            foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
                if ($item->$field && Storage::disk('public')->exists($item->$field)) {
                    Storage::disk('public')->delete($item->$field);
                }
            }
        }

        Press::truncate();

        return redirect()->back()->with('success', 'All press entries deleted successfully');
    }

    /**
     * Serve a press asset (download/view)
     */
    public function asset($id, $type)
    {
        $press = Press::findOrFail($id);
        
        if (!in_array($type, ['icon', 'photo', 'pdf', 'guideline_pdf'])) {
            abort(404);
        }
        
        $filePath = $press->$type;
        
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        
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
            'Content-Disposition' => 'inline',
        ]);
    }
}
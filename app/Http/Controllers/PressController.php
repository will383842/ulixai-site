<?php

namespace App\Http\Controllers;

use App\Models\Press;
use App\Models\PressInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PressController extends Controller
{
    /**
     * Display press page (public)
     */
    public function index($locale = 'en')
    {
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
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'language' => 'required|in:en,fr,de',
            'press_id' => 'nullable|integer|exists:press,id',
            'icon' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'pdf' => 'nullable|file|mimes:pdf|max:20480',
            'guideline_pdf' => 'nullable|file|mimes:pdf|max:20480',
            'photo' => 'nullable|file|mimes:png,jpg,jpeg,webp|max:10240',
        ]);

        $press = null;
        
        if (!empty($validated['press_id'])) {
            $press = Press::find($validated['press_id']);
        } else {
            $press = Press::where('language', $validated['language'])->first();
        }
        
        if (!$press) {
            $press = new Press();
            $press->language = $validated['language'];
        }

        $press->title = $validated['title'] ?? $press->title;
        $press->description = $validated['description'] ?? $press->description;

        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
            if ($request->hasFile($field)) {
                if ($press->{$field} && Storage::disk('public')->exists($press->{$field})) {
                    Storage::disk('public')->delete($press->{$field});
                }
                $press->{$field} = $request->file($field)->store('press', 'public');
            }
        }

        $press->save();

        return response()->json([
            'success' => true,
            'message' => 'Press item created successfully',
            'press_id' => $press->id
        ]);
    }

    /**
     * Upload a single file (AJAX - ADMIN)
     */
    public function upload(Request $request)
    {
        try {
            $validated = $request->validate([
                'file' => 'required|file|max:20480',
                'type' => 'required|in:icon,pdf,guideline_pdf,photo',
                'language' => 'required|in:en,fr,de',
                'press_id' => 'nullable|integer|exists:press,id',
            ]);

            $press = null;
            
            if (!empty($validated['press_id'])) {
                $press = Press::find($validated['press_id']);
            } else {
                $press = Press::where('language', $validated['language'])->first();
            }

            if (!$press) {
                $press = new Press();
                $press->language = $validated['language'];
                $press->title = null;
                $press->description = null;
            }

            $fieldName = $validated['type'];

            if ($press->{$fieldName} && Storage::disk('public')->exists($press->{$fieldName})) {
                Storage::disk('public')->delete($press->{$fieldName});
            }

            $path = $request->file('file')->store('press', 'public');
            $press->{$fieldName} = $path;
            $press->save();

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'press_id' => $press->id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete a specific file (AJAX - ADMIN)
     */
    public function delete(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|in:icon,pdf,guideline_pdf,photo',
                'language' => 'required|in:en,fr,de',
                'press_id' => 'nullable|integer|exists:press,id',
            ]);

            $press = null;
            
            if (!empty($validated['press_id'])) {
                $press = Press::find($validated['press_id']);
            } else {
                $press = Press::where('language', $validated['language'])->first();
            }

            if (!$press) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found'
                ], 404);
            }

            $fieldName = $validated['type'];

            if ($press->{$fieldName} && Storage::disk('public')->exists($press->{$fieldName})) {
                Storage::disk('public')->delete($press->{$fieldName});
            }

            $press->{$fieldName} = null;
            $press->save();

            return response()->json([
                'success' => true,
                'message' => 'File deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get existing files (AJAX - ADMIN)
     */
    public function getFiles(Request $request)
    {
        $language = $request->query('language', 'en');
        $press_id = $request->query('press_id');

        $press = null;
        
        if ($press_id) {
            $press = Press::find($press_id);
        } else {
            $press = Press::where('language', $language)->first();
        }

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
                    'name' => $press->title ?? 'Untitled',
                    'url' => Storage::disk('public')->url($press->{$type})
                ];
            }
        }

        return response()->json([
            'success' => true,
            'files' => $files,
            'press_id' => $press->id,
            'title' => $press->title
        ]);
    }

    /**
     * Destroy a press entry (ADMIN)
     */
    public function destroy($id)
    {
        try {
            $press = Press::findOrFail($id);

            foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
                if ($press->$field && Storage::disk('public')->exists($press->$field)) {
                    Storage::disk('public')->delete($press->$field);
                }
            }

            $press->delete();

            return redirect()->back()->with('success', '✅ Press item deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error: ' . $e->getMessage());
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
     * Serve a press asset
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
     * Preview a press asset
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

    /**
     * 🆕 Store press inquiry from contact form (PUBLIC)
     */
    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'media_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:255',
            'languages_spoken' => 'nullable|string|max:255',
            'how_heard' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:5000',
        ]);

        try {
            PressInquiry::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Press inquiry submitted successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting your inquiry'
            ], 500);
        }
    }
}
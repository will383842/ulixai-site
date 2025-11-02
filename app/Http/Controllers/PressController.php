<?php

namespace App\Http\Controllers;

use App\Models\Press;
use App\Models\PressInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PressController extends Controller
{
    /**
     * Public press hub page for a given locale.
     * Renders resources for en/fr/de without changing any public interface.
     */
    public function index($locale = 'en')
    {
        $pressItems = Press::where('language', $locale)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view("press.$locale", [
            'pressItems'  => $pressItems,
            'locale'      => $locale,
            'showContent' => true,
        ]);
    }

    /**
     * Store or update a Press record (ADMIN, JSON).
     * Accepts optional files: icon, pdf, guideline_pdf, photo.
     * If press_id is provided, updates that row. Otherwise ensures a single row per language.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'language'      => 'required|in:en,fr,de',
            'press_id'      => 'nullable|integer|exists:press,id',
            'icon'          => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'photo'         => 'nullable|file|mimes:png,jpg,jpeg,webp|max:10240',
            'pdf'           => 'nullable|file|mimes:pdf|max:20480',
            'guideline_pdf' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $press = null;
        if (!empty($validated['press_id'])) {
            $press = Press::find($validated['press_id']);
        } else {
            // One row per language, avoid duplicates
            $press = Press::firstOrCreate(['language' => $validated['language']]);
        }

        // Safe text fields
        if (array_key_exists('title', $validated)) {
            $press->title = $validated['title'];
        }
        if (array_key_exists('description', $validated)) {
            $press->description = $validated['description'];
        }

        // Handle file replacements
        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
            if ($request->hasFile($field)) {
                if (!empty($press->{$field}) && Storage::disk('public')->exists($press->{$field})) {
                    Storage::disk('public')->delete($press->{$field});
                }
                $press->{$field} = $request->file($field)->store('press', 'public');
            }
        }

        $press->save();

        return response()->json([
            'success'  => true,
            'message'  => 'Press item saved',
            'press_id' => $press->id,
        ]);
    }

    /**
     * AJAX upload for a single asset (ADMIN).
     * Keeps public API stable: type ∈ [icon,pdf,guideline_pdf,photo], language ∈ [en,fr,de].
     */
    public function upload(Request $request)
    {
        $v = Validator::make($request->all(), [
            'type'      => 'required|in:icon,pdf,guideline_pdf,photo',
            'language'  => 'required|in:en,fr,de',
            'press_id'  => 'nullable|integer|exists:press,id',
        ]);

        if ($v->fails()) {
            return response()->json(['success' => false, 'message' => $v->errors()->first()], 422);
        }

        $type = $request->input('type');
        $language = $request->input('language');

        // Per-type validation
        $rulesByType = [
            'icon'          => 'required|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'photo'         => 'required|file|mimes:png,jpg,jpeg,webp|max:10240',
            'pdf'           => 'required|file|mimes:pdf|max:20480',
            'guideline_pdf' => 'required|file|mimes:pdf|max:20480',
        ];
        $request->validate(['file' => $rulesByType[$type]]);

        // Target row
        if ($request->filled('press_id')) {
            $press = Press::find($request->input('press_id'));
        } else {
            $press = Press::firstOrCreate(['language' => $language]);
        }

        // Replace old file if present
        if (!empty($press->{$type}) && Storage::disk('public')->exists($press->{$type})) {
            Storage::disk('public')->delete($press->{$type});
        }

        $path = $request->file('file')->store('press', 'public');
        $press->{$type} = $path;
        $press->save();

        return response()->json([
            'success'  => true,
            'message'  => 'File uploaded successfully',
            'press_id' => $press->id,
            'url'      => Storage::disk('public')->url($path),
        ]);
    }

    /**
     * List existing files for a language/press_id (ADMIN).
     * Always pick the most recently updated row to avoid duplicates confusion.
     */
    public function getFiles(Request $request)
    {
        $language = $request->query('language', 'en');
        $press_id = $request->query('press_id');

        if (!empty($press_id)) {
            $press = Press::find($press_id);
        } else {
            $press = Press::where('language', $language)
                ->orderBy('updated_at', 'desc')
                ->first();
        }

        if (!$press) {
            return response()->json(['success' => true, 'files' => [], 'press_id' => null]);
        }

        $files = [];
        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $type) {
            if (!empty($press->{$type})) {
                $files[$type] = [
                    'id'   => $press->id,
                    'name' => $press->title ?? 'Press',
                    'url'  => Storage::disk('public')->url($press->{$type}),
                ];
            }
        }

        return response()->json([
            'success'  => true,
            'files'    => $files,
            'press_id' => $press->id,
            'title'    => $press->title,
        ]);
    }

    /**
     * Delete a specific asset on a press row (ADMIN, JSON).
     */
    public function delete(Request $request)
    {
        $validated = $request->validate([
            'type'      => 'required|in:icon,pdf,guideline_pdf,photo',
            'language'  => 'required|in:en,fr,de',
            'press_id'  => 'nullable|integer|exists:press,id',
        ]);

        $type     = $validated['type'];
        $language = $validated['language'];

        if (!empty($validated['press_id'])) {
            $press = Press::find($validated['press_id']);
        } else {
            $press = Press::where('language', $language)
                ->orderBy('updated_at', 'desc')
                ->first();
        }

        if (!$press) {
            return response()->json(['success' => true, 'message' => 'Nothing to delete']);
        }

        if (!empty($press->{$type}) && Storage::disk('public')->exists($press->{$type})) {
            Storage::disk('public')->delete($press->{$type});
        }
        $press->{$type} = null;
        $press->save();

        return response()->json(['success' => true, 'message' => 'Deleted']);
    }

    /**
     * Hard delete a press row (ADMIN).
     */
    public function destroy($id)
    {
        $press = Press::findOrFail($id);

        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $field) {
            if (!empty($press->{$field}) && Storage::disk('public')->exists($press->{$field})) {
                Storage::disk('public')->delete($press->{$field});
            }
        }

        $press->delete();

        return redirect()->back()->with('success', 'Press entry deleted');
    }

    /**
     * Inline preview of a press asset (public disk).
     */
    public function preview($id, $type)
    {
        $press = Press::findOrFail($id);

        if (!in_array($type, ['icon', 'photo', 'pdf', 'guideline_pdf'])) {
            abort(404);
        }

        $filePath = $press->{$type};
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404);
        }

        $fullPath = storage_path('app/public/' . $filePath);
        $mime = function_exists('mime_content_type') ? mime_content_type($fullPath) : 'application/octet-stream';

        return response()->file($fullPath, [
            'Content-Type'        => $mime,
            'Content-Disposition' => 'inline',
        ]);
    }

    // Optional Inquiry endpoints kept for backward compatibility
    public function storeInquiry(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'message'    => 'required|string|max:5000',
            'company'    => 'nullable|string|max:255',
            'website'    => 'nullable|url|max:255',
        ]);

        $inq = new PressInquiry();
        $inq->fill($data);
        $inq->status = 'new';
        $inq->save();

        return response()->json(['success' => true]);
    }

    public function inquiriesPage()
    {
        return view('admin.press.inquiries');
    }

    public function inquiriesList(Request $request)
    {
        $items = PressInquiry::query()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($items);
    }

    public function markAsRead($inquiryId)
    {
        $inq = PressInquiry::findOrFail($inquiryId);
        $inq->status = 'read';
        $inq->save();
        return response()->json(['success' => true]);
    }
}

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
     * Display press page (public)
     */
    public function index($locale = 'en')
    {
        $pressItems = Press::where('language', $locale)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('press.index', [
            'pressItems'  => $pressItems,
            'locale'      => $locale,
            'showContent' => true,
        ]);
    }

    /**
     * Store a new press item (ADMIN)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'language'      => 'required|in:en,fr,de',
            'press_id'      => 'nullable|integer|exists:press,id',
            'icon'          => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:5120',
            'pdf'           => 'nullable|file|mimes:pdf|max:20480',
            'guideline_pdf' => 'nullable|file|mimes:pdf|max:20480',
            'photo'         => 'nullable|file|mimes:png,jpg,jpeg,webp|max:10240',
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
            'success'  => true,
            'message'  => 'Press item created successfully',
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
                'file'      => 'required|file|max:20480',
                'type'      => 'required|in:icon,pdf,guideline_pdf,photo',
                'language'  => 'required|in:en,fr,de',
                'press_id'  => 'nullable|integer|exists:press,id',
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
                'success'  => true,
                'message'  => 'File uploaded successfully',
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
                'type'      => 'required|in:icon,pdf,guideline_pdf,photo',
                'language'  => 'required|in:en,fr,de',
                'press_id'  => 'nullable|integer|exists:press,id',
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
                'files'   => []
            ]);
        }

        $files = [];
        foreach (['icon', 'pdf', 'guideline_pdf', 'photo'] as $type) {
            if (!empty($press->{$type})) {
                $files[$type] = [
                    'id'   => $press->id,
                    'name' => $press->title ?? 'Untitled',
                    'url'  => Storage::disk('public')->url($press->{$type})
                ];
            }
        }

        return response()->json([
            'success'  => true,
            'files'    => $files,
            'press_id' => $press->id,
            'title'    => $press->title
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
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline',
        ]);
    }

    /**
     * Store press inquiry from contact form (PUBLIC)
     * - Tout est REQUIS sauf website ; téléphone avec indicatif (E.164).
     * - Accepte quelques alias de champs côté front.
     */
    public function storeInquiry(Request $request)
    {
        // Normaliser les clés (alias possibles)
        $mediaName = $request->input('media_name') ?? $request->input('media') ?? $request->input('company');
        $fullName  = $request->input('full_name') ?? $request->input('name')
                   ?? trim(($request->input('first_name') ?? '').' '.($request->input('last_name') ?? ''));
        $email     = $request->input('email') ?? $request->input('email_address');

        // Téléphone : combine dial code + numéro, sortie en E.164
        $rawPhone  = $request->input('phone') ?? $request->input('phone_number');
        $dial      = $request->input('phone_country_code') ?? $request->input('dial_code') ?? $request->input('country_code'); // +33 ou 33

        // Nettoyage indicatif
        if (!empty($dial)) {
            $dial = '+' . ltrim(preg_replace('/\D+/', '', (string)$dial), '+');
        }

        if (preg_match('/^\+/', (string)$rawPhone)) {
            $normalizedPhone = '+' . ltrim(preg_replace('/\D+/', '', (string)$rawPhone), '+');
        } elseif (!empty($dial)) {
            $normalizedPhone = $dial . preg_replace('/\D+/', '', (string)$rawPhone);
        } else {
            // forcera une erreur de validation (indicatif obligatoire)
            $normalizedPhone = (string)$rawPhone;
        }

        // Website : ajouter https:// si manquant
        $website = $request->input('website') ?? $request->input('site');
        if (!empty($website) && !preg_match('~^https?://~i', $website)) {
            $website = 'https://' . $website;
        }

        $data = [
            'media_name'       => $mediaName,
            'full_name'        => $fullName,
            'email'            => $email,
            'phone'            => $normalizedPhone,
            'website'          => $website, // seul champ non requis
            'languages_spoken' => $request->input('languages_spoken') ?? $request->input('languages'),
            'how_heard'        => $request->input('how_heard') ?? $request->input('source'),
            'message'          => $request->input('message'),
        ];

        // Validation : tout requis sauf website
        $validated = Validator::make($data, [
            'media_name'       => 'required|string|max:255',
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => ['required', 'regex:/^\+[1-9]\d{6,14}$/'], // E.164
            'website'          => 'nullable|url|max:255',
            'languages_spoken' => 'required|string|max:255',
            'how_heard'        => 'required|string|max:255',
            'message'          => 'required|string|max:5000',
        ], [
            'phone.regex' => 'Le téléphone doit inclure l’indicatif pays (ex: +33...).',
        ])->validate();

        // Status par défaut: pending (dans la BDD aussi)
        $validated['status'] = 'pending';

        PressInquiry::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Press inquiry submitted successfully'
        ], 201);
    }

    /**
     * ADMIN — page Blade listant les messages
     */
    public function inquiriesPage()
    {
        return view('admin.press-inquiries');
    }

    /**
     * ADMIN — API JSON paginée des messages (filtres: status, search)
     */
    public function inquiriesList(Request $request)
    {
        $q = PressInquiry::query()->orderByDesc('created_at');

        if ($request->filled('status')) {
            $q->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $s = (string) $request->input('search');
            $q->where(function ($qq) use ($s) {
                $qq->where('media_name', 'like', "%{$s}%")
                   ->orWhere('full_name', 'like', "%{$s}%")
                   ->orWhere('email', 'like', "%{$s}%")
                   ->orWhere('message', 'like', "%{$s}%");
            });
        }

        return response()->json($q->paginate(20));
    }

    /**
     * ADMIN — marquer un message comme lu (status = read)
     */
    public function markAsRead(PressInquiry $inquiry)
    {
        $inquiry->update(['status' => 'read']);
        return response()->noContent();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PressAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PressController extends Controller
{
    /**
     * Vue admin – gestion des assets (uploads presse)
     */
    public function index()
    {
        return view('admin.press.index');
    }

    /**
     * JSON – liste paginée/filtrée pour le tableau
     */
    public function assets(Request $request)
    {
        $request->validate([
            'type' => ['nullable','string'],
            'locale' => ['nullable','string','max:8'],
            'search' => ['nullable','string','max:120'],
            'sort' => ['nullable', Rule::in(['created_at','title','filename','size'])],
            'direction' => ['nullable', Rule::in(['asc','desc'])],
            'page' => ['nullable','integer','min:1'],
            'per_page' => ['nullable','integer','min:1','max:100'],
        ]);

        $q = PressAsset::query();

        if ($request->filled('type') && $request->type !== 'all') {
            $q->where('type', $request->type);
        }
        if ($request->filled('locale') && $request->locale !== 'all') {
            $q->where('locale', $request->locale);
        }
        if ($request->filled('search')) {
            $s = trim($request->search);
            $q->where(function($w) use ($s) {
                $w->where('title', 'like', "%{$s}%")
                  ->orWhere('filename', 'like', "%{$s}%");
            });
        }

        $sort = $request->input('sort', 'created_at');
        $dir  = $request->input('direction', 'desc');

        $q->orderBy($sort, $dir);

        $perPage = (int) $request->input('per_page', 20);
        $p = $q->paginate($perPage);

        return response()->json([
            'data' => $p->items(),
            'pagination' => [
                'total' => $p->total(),
                'page' => $p->currentPage(),
                'pages' => $p->lastPage(),
            ],
        ]);
    }

    /**
     * POST – upload d’un ou plusieurs fichiers
     */
    public function upload(Request $request)
    {
        $request->validate([
            'type'   => ['required', Rule::in(['logo','kit','release','visual','other'])],
            'locale' => ['nullable','string','max:8'],
            'title'  => ['nullable','string','max:160'],
            'files.*' => ['required','file','max:20480', // 20 MB
                'mimetypes:image/png,image/jpeg,image/webp,application/pdf,application/zip,video/mp4'
            ],
        ]);

        $disk   = 'public';
        $locale = $request->input('locale', 'all');
        $type   = $request->input('type');

        $saved = [];

        foreach ((array) $request->file('files', []) as $file) {
            $safeName = uniqid().'-'.preg_replace('/[^a-zA-Z0-9_\.-]/','_', $file->getClientOriginalName());
            $dir = "press/{$type}/{$locale}";
            $path = $file->storeAs($dir, $safeName, $disk);

            $saved[] = PressAsset::create([
                'title'     => $request->input('title'),
                'type'      => $type,
                'locale'    => $locale,
                'disk'      => $disk,
                'path'      => $path,
                'filename'  => $file->getClientOriginalName(),
                'mime'      => $file->getMimeType(),
                'size'      => $file->getSize(),
                'created_by'=> optional(Auth::guard('admin')->user())->id,
            ]);
        }

        return response()->json([
            'ok' => true,
            'count' => count($saved),
            'items' => $saved,
        ]);
    }

    /**
     * GET – téléchargement
     */
    public function download(PressAsset $asset)
    {
        return Storage::disk($asset->disk)->download($asset->path, $asset->filename);
    }

    /**
     * DELETE – suppression
     */
    public function destroy(PressAsset $asset)
    {
        Storage::disk($asset->disk)->delete($asset->path);
        $asset->delete();

        return response()->noContent();
    }
}

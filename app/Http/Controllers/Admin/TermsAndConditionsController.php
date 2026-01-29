<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TermsAndConditionsController extends Controller
{
    /**
     * Admin index page - shows tabs for all terms types
     */
    public function termsIndex()
    {
        $types = TermsSection::getTypes();
        return view('admin.dashboard.terms-n-conditions.index', compact('types'));
    }

    /**
     * Fetch sections for a specific type
     * GET /admin/terms/fetch?type=general|client|provider|affiliate
     */
    public function fetch(Request $request)
    {
        $type = $request->get('type', TermsSection::TYPE_GENERAL);

        // Validate type
        if (!array_key_exists($type, TermsSection::getTypes())) {
            $type = TermsSection::TYPE_GENERAL;
        }

        // Get section for this type (single section per type)
        $section = TermsSection::ofType($type)
            ->where('is_active', true)
            ->first();

        // If no section exists, create a default one
        if (!$section) {
            $section = TermsSection::create([
                'number' => 1,
                'title' => TermsSection::getTypes()[$type],
                'slug' => $type . '-terms',
                'type' => $type,
                'body' => '',
                'is_active' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'sections' => [$section],
            'type' => $type,
        ]);
    }

    /**
     * Store/update a section
     * POST /admin/terms
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id'            => ['nullable','integer','exists:terms_sections,id'],
            'number'        => ['required','integer','min:1'],
            'title'         => ['required','string','max:255'],
            'body'          => ['nullable','string'],
            'type'          => ['nullable','string','in:general,client,provider,affiliate'],
            'is_active'     => ['sometimes','boolean'],
            'version'       => ['nullable','string','max:50'],
            'effective_date'=> ['nullable','date'],
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['type'] = $data['type'] ?? TermsSection::TYPE_GENERAL;

        // If ID provided, update; else upsert by type
        if ($request->id) {
            $section = TermsSection::findOrFail($request->id);
        } else {
            $section = TermsSection::firstOrNew([
                'type' => $data['type']
            ]);
        }

        $section->fill($data)->save();

        return response()->json([
            'success' => true,
            'section' => $section->fresh(),
            'message' => 'Section enregistrée.',
        ]);
    }

    /**
     * Public page: General Terms & Conditions
     */
    public function showTerms()
    {
        $section = TermsSection::ofType(TermsSection::TYPE_GENERAL)
            ->where('is_active', true)
            ->first();

        $appName = config('app.name');
        $body = $section ? str_replace('@site', $appName, $section->body ?? '') : '';

        $sections = [[
            'number' => 1,
            'title' => 'Conditions Générales d\'Utilisation',
            'slug' => 'general-terms',
            'body' => $body,
        ]];

        return view('pages.termsnconditions', compact('sections'));
    }

    /**
     * Public page: Client Terms & Conditions
     */
    public function showClientTerms()
    {
        $section = TermsSection::ofType(TermsSection::TYPE_CLIENT)
            ->where('is_active', true)
            ->first();

        $appName = config('app.name');
        $body = $section ? str_replace('@site', $appName, $section->body ?? '') : '';

        return view('pages.terms-client', [
            'content' => $body,
            'title' => 'Conditions Générales Clients',
            'lastUpdated' => $section?->updated_at?->format('F Y') ?? date('F Y'),
        ]);
    }

    /**
     * Public page: Provider Terms & Conditions
     */
    public function showProviderTerms()
    {
        $section = TermsSection::ofType(TermsSection::TYPE_PROVIDER)
            ->where('is_active', true)
            ->first();

        $appName = config('app.name');
        $body = $section ? str_replace('@site', $appName, $section->body ?? '') : '';

        return view('pages.terms-provider', [
            'content' => $body,
            'title' => 'Conditions Générales Prestataires',
            'lastUpdated' => $section?->updated_at?->format('F Y') ?? date('F Y'),
        ]);
    }

    /**
     * Public page: Affiliate Terms & Conditions
     */
    public function showAffiliateTerms()
    {
        $section = TermsSection::ofType(TermsSection::TYPE_AFFILIATE)
            ->where('is_active', true)
            ->first();

        $appName = config('app.name');
        $body = $section ? str_replace('@site', $appName, $section->body ?? '') : '';

        return view('pages.terms-affiliate', [
            'content' => $body,
            'title' => 'Conditions Générales d\'Affiliation',
            'lastUpdated' => $section?->updated_at?->format('F Y') ?? date('F Y'),
        ]);
    }
}

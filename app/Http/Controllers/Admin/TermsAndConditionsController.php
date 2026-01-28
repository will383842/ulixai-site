<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TermsAndConditionsController extends Controller
{
    public function termsIndex()
    {
        return view('admin.dashboard.terms-n-conditions.index');
    }

    /**
     * Seed (if needed) and return all sections.
     * GET /admin/terms/fetch
     */
    public function fetch(Request $request)
    {
        // Your default headings (matches your screenshot order)
        $defaults = [
            1  => 'Accepting the terms',
            2  => 'Changes to terms',
            3  => 'Using our product',
            4  => 'General restrictions',
            5  => 'Content policy',
            6  => 'Your rights',
            7  => 'Copyright policy',
            8  => 'Relationship guidelines',
            9  => 'Liability Policy',
            10 => 'General legal terms',
        ];

        // Upsert by slug so it’s idempotent
        foreach ($defaults as $num => $title) {
            $slug = Str::slug($title);
            TermsSection::updateOrCreate(
                ['slug' => $slug],
                [
                    'number' => $num,
                    'title'  => $title,
                    // leave body null on first run; admins can edit later
                    'is_active' => true,
                    'version' => $request->get('version'), // optional pass-through
                ]
            );
        }

        $sections = TermsSection::query()
            ->where('is_active', true)
            ->orderBy('number')
            ->get(['id','number','title','slug','body','version','effective_date','is_active','updated_at']);

        return response()->json([
            'success'  => true,
            'sections' => $sections,
        ]);
    }

    /**
     * Create or update a single section body/title (from an admin editor).
     * POST /admin/terms
     */
    public function store(Request $request)
    {
        // validate request
        $data = $request->validate([
            'id'            => ['nullable','integer','exists:terms_sections,id'],
            'number'        => ['required','integer','min:1'],
            'title'         => ['required','string','max:255'],
            'body'          => ['nullable','string'],
            'is_active'     => ['sometimes','boolean'],
            'version'       => ['nullable','string','max:50'],
            'effective_date'=> ['nullable','date'],
        ]);

        $data['slug'] = Str::slug($data['title']);

        // If ID provided, update; else upsert by slug
        $section = $request->id
            ? TermsSection::findOrFail($request->id)
            : TermsSection::firstOrNew(['slug' => $data['slug']]);

        $section->fill($data)->save();

        return response()->json([
            'success' => true,
            'section' => $section->fresh(),
            'message' => 'Section saved.',
        ]);




    }


      public function ShowTerms()
    {
        // Fixed order & titles (match your sidebar)
        $defaults = [
            ['number'=>1,  'title'=>'Accepting the terms',     'slug'=>'accepting-the-terms'],
            ['number'=>2,  'title'=>'Changes to terms',        'slug'=>'changes-to-terms'],
            ['number'=>3,  'title'=>'Using our product',       'slug'=>'using-our-product'],
            ['number'=>4,  'title'=>'General restrictions',    'slug'=>'general-restrictions'],
            ['number'=>5,  'title'=>'Content policy',          'slug'=>'content-policy'],
            ['number'=>6,  'title'=>'Your rights',             'slug'=>'your-rights'],
            ['number'=>7,  'title'=>'Copyright policy',        'slug'=>'copyright-policy'],
            ['number'=>8,  'title'=>'Relationship guidelines', 'slug'=>'relationship-guidelines'],
            ['number'=>9,  'title'=>'Liability Policy',        'slug'=>'liability-policy'],
            ['number'=>10, 'title'=>'General legal terms',     'slug'=>'general-legal-terms'],
        ];

        $map = TermsSection::where('is_active', true)
            ->get(['slug','number','title','body'])
            ->keyBy('slug');

        $appName = config('app.name');

        // Merge DB bodies into fixed list; replace @site
        $sections = array_map(function ($d) use ($map, $appName) {
            $body = optional($map->get($d['slug']))->body ?? '';
            $body = str_replace('@site', $appName, $body);
            return [
                'number' => $d['number'],
                'title'  => $d['title'],
                'slug'   => $d['slug'],
                'body'   => $body,
            ];
        }, $defaults);

       return view('pages.termsnconditions', compact('sections'));

    }
}

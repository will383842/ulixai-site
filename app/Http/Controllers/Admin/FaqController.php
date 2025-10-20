<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('admin.dashboard.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);
        
        Faq::create($validated);

        return redirect()->back()->with('success', 'FAQ created successfully');
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'FAQ updated successfully'
        ]);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->with('success', 'FAQ deleted successfully');
    }

    public function updateOrder(Request $request)
    {
        $items = $request->get('items');
        
        foreach($items as $item) {
            Faq::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}

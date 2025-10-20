<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private function ensureUploadDirectoryExists()
    {
        $uploadPath = public_path('uploads/categories');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        return $uploadPath;
    }

    public function index()
    {
        $mainCategories = Category::with(['subCategories' => function($query) {
            $query->orderBy('sort_order');
        }, 'subCategories.subSubCategories' => function($query) {
            $query->orderBy('sort_order');
        }])
        ->mainCategories()
        ->orderBy('sort_order')
        ->get();
        
        return view('admin.dashboard.category.index', compact('mainCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:1,2,3',
            'parent_id' => 'required_unless:level,1|nullable|exists:categories,id',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'level' => $request->level,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
            'is_active' => true
        ];

        if ($request->hasFile('icon_image')) {
            $uploadPath = $this->ensureUploadDirectoryExists();
            $image = $request->file('icon_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $filename);
            $data['icon_image'] = 'uploads/categories/' . $filename;
        }

        Category::create($data);

        return redirect()->back()->with('success', 'Category created successfully');
    }

  public function update(Request $request, Category $category)
{
    $request->validate([
        'name'       => 'required|string|max:255',
        'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'bg_color'   => 'nullable|string|max:20',
    ]);

    $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
    ];

    if ($request->hasFile('icon_image')) {
        if ($category->icon_image && file_exists(public_path($category->icon_image))) {
            @unlink(public_path($category->icon_image));
        }
        $uploadPath = $this->ensureUploadDirectoryExists();
        $image = $request->file('icon_image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $image->move($uploadPath, $filename);
        $data['icon_image'] = 'uploads/categories/'.$filename;
    }

    // Fill safe fields
    $category->fill($data);

    // Explicitly assign color (bypasses fillable)
    $category->bg_color = $request->bg_color ?: null;

    $category->save();

    return back()->with('success', 'Category updated successfully');
}



    public function destroy(Category $category)
    {
        if ($category->icon_image && file_exists(public_path($category->icon_image))) {
            unlink(public_path($category->icon_image));
        }
        $missions = $category->missions;

        if($category->level == 1) {
            foreach($missions as $mission) {
                $mission->category_id = null;
                $mission->subcategory_id = null;
                $mission->subsubcategory_id = null;
                $mission->save();
            }
        } elseif($category->level == 2) {
            foreach($missions as $mission) {
                $mission->subcategory_id = null;
                $mission->subsubcategory_id = null;
                $mission->save();
            }
        }  elseif($category->level == 3) {
            foreach($missions as $mission) {
                $mission->subsubcategory_id = null;
                $mission->save();
            }
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully');
    }

    public function updateOrder(Request $request)
    {
        $categories = $request->get('categories');
        
        foreach ($categories as $order => $categoryId) {
            Category::where('id', $categoryId)
                   ->update(['sort_order' => $order]);
        }
        
        return response()->json(['success' => true]);
    }

    public function updateSingleOrder(Request $request, Category $category)
    {
        $request->validate([
            'sort_order' => 'required|integer|min:0'
        ]);

        $category->update(['sort_order' => $request->sort_order]);
        
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function fetchMainCategories()
    {
        $categories = Category::mainCategories()->active()->orderBy('sort_order')->get(['id', 'name', 'slug','bg_color', 'icon_image']);
        return response()->json(['success' => true, 'categories' => $categories]);
    }

    public function fetchSubCategories($parentId)
    {
        $subcategories = Category::where('parent_id', $parentId)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'name', 'slug', 'icon_image','bg_color']);

        return response()->json(['success' => true, 'subcategories' => $subcategories]);
    }

    public function fetchChildCategories($parentId)
    {
        $subcategories = Category::where('parent_id', $parentId)
                                ->where('is_active', true)
                                ->orderBy('sort_order')
                                ->get(['id', 'name', 'level', 'slug', 'icon_image','bg_color']); // fetch only relevant fields

        return response()->json([
            'success' => true,
            'subcategories' => $subcategories
        ]);
    }

}

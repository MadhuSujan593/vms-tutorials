<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tutorial;

class PublicController extends Controller
{
    public function home()
    {
        $categories = Category::withCount(['tutorials' => function($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();
        return view('public.home', compact('categories'));
    }

    public function category(Category $category)
    {
        $tutorials = $category->tutorials()->where('is_published', true)->orderBy('sort_order')->get();
        return view('public.category', compact('category', 'tutorials'));
    }

    public function tutorial(Category $category, Tutorial $tutorial)
    {
        if (!$tutorial->is_published) {
            abort(404);
        }

        $allTutorials = $category->tutorials()->where('is_published', true)->orderBy('sort_order')->get();
        
        return view('public.tutorial', compact('category', 'tutorial', 'allTutorials'));
    }
}

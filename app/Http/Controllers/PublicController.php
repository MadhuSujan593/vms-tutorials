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
        $tutorials = $category->tutorials()
                              ->where('is_published', true)
                              ->whereNull('parent_id')
                              ->with(['children' => function($q) {
                                  $q->where('is_published', true)->orderBy('sort_order');
                              }])
                              ->orderBy('sort_order')
                              ->get();
                              
        return view('public.category', compact('category', 'tutorials'));
    }

    public function tutorial(Category $category, Tutorial $tutorial)
    {
        if (!$tutorial->is_published) {
            abort(404);
        }

        // If this is a parent and has children, redirect to the first child for consistency
        if ($tutorial->parent_id === null && $tutorial->children()->where('is_published', true)->exists()) {
            $firstChild = $tutorial->children()->where('is_published', true)->orderBy('sort_order')->first();
            return redirect()->route('public.tutorial', [$category->slug, $firstChild->slug]);
        }

        $allTutorials = $category->tutorials()
                                 ->where('is_published', true)
                                 ->whereNull('parent_id')
                                 ->with(['children' => function($q) {
                                     $q->where('is_published', true)->orderBy('sort_order');
                                 }])
                                 ->orderBy('sort_order')
                                 ->get();
        
        $flattenedTutorials = collect();
        foreach($allTutorials as $t) {
            $flattenedTutorials->push($t);
            foreach($t->children as $c) {
                $flattenedTutorials->push($c);
            }
        }
        
        return view('public.tutorial', compact('category', 'tutorial', 'allTutorials', 'flattenedTutorials'));
    }
}

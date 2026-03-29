<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tutorial;
use App\Models\Banner;

class PublicController extends Controller
{
    private function getActiveBanners()
    {
        return Banner::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    }

    public function home()
    {
        $categories = Category::withCount(['tutorials' => function($query) {
            $query->where('is_published', true);
        }])->orderBy('name')->get();

        $banners = $this->getActiveBanners();
        $title = "VMS Tutorials - Master Modern Technology";
        $metaDescription = "Step-by-step professional coding tutorials for PHP, Java, JavaScript, and more. Master backend logic and frontend brilliance with industry-standard guides.";

        return view('public.home', compact('categories', 'banners', 'title', 'metaDescription'));
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
        
        $banners = $this->getActiveBanners();
        $title = $category->name . " Tutorials - Master " . $category->name . " Step-by-Step";
        $metaDescription = $category->description ?? "Comprehensive tutorials and professional guides for " . $category->name . ". Learn from scratch and build real-world applications.";
                              
        return view('public.category', compact('category', 'tutorials', 'banners', 'title', 'metaDescription'));
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

        $banners = $this->getActiveBanners();
        $title = $tutorial->title . " | " . $category->name . " Tutorial";
        $metaDescription = \App\View\Components\Markdown::getExcerpt($tutorial->content);
        
        return view('public.tutorial', compact('category', 'tutorial', 'allTutorials', 'flattenedTutorials', 'banners', 'title', 'metaDescription'));
    }
}

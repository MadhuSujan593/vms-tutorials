<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Tutorial;
use App\Models\Banner;
use App\Models\Course;

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
        $courses = Course::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        $title = "VMS Tutorials - Master Modern Technology";
        $metaDescription = "Step-by-step professional coding tutorials for PHP, Java, JavaScript, and more. Master backend logic and frontend brilliance with industry-standard guides.";

        return view('public.home', compact('categories', 'banners', 'courses', 'title', 'metaDescription'));
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

        // If this is a parent and has children, we used to redirect to first child,
        // but now we allow viewing the parent's content directly.

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

    public function about()
    {
        $title = "About Us | VMS Tutorials";
        $metaDescription = "Learn more about VMS Tutorials, our mission to provide high-quality coding education, and the team behind the brilliance.";
        return view('public.about', compact('title', 'metaDescription'));
    }

    public function contact()
    {
        $title = "Contact Us | VMS Tutorials";
        $metaDescription = "Get in touch with the VMS Tutorials team. We're here to answer your questions and help you on your learning journey.";
        return view('public.contact', compact('title', 'metaDescription'));
    }

    public function courses()
    {
        $courses = Course::where('is_active', true)->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(12);
        $title = "Our Courses | VMS Tutorials";
        $metaDescription = "Explore our premium coding courses. Master modern technologies with professional, high-quality video and text-based guides.";
        return view('public.courses', compact('courses', 'title', 'metaDescription'));
    }
    public function donate()
    {
        $title = "Support VMS Tutorials | Donate";
        $metaDescription = "Support our mission to provide high-quality technology education. Your donations help us keep our content free and up-to-date.";
        return view('public.donate', compact('title', 'metaDescription'));
    }
}

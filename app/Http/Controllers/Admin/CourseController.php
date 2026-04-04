<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'redirect_url' => 'required|url|max:255',
            'image_path' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120', // Max 5MB
            'is_active' => 'nullable',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('courses', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        
        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'redirect_url' => 'required|url|max:255',
            'image_path' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:5120',
            'is_active' => 'nullable',
            'sort_order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_path')) {
            if ($course->image_path) {
                Storage::disk('public')->delete($course->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('courses', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->image_path) {
            Storage::disk('public')->delete($course->image_path);
        }
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}

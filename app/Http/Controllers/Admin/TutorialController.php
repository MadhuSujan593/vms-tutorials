<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tutorial;
use App\Models\Category;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = Tutorial::with('category')->latest()->paginate(10);
        return view('admin.tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tutorials.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        Tutorial::create($validated);
        
        return redirect()->route('admin.tutorials.index')->with('success', 'Tutorial created successfully.');
    }

    public function show(Tutorial $tutorial)
    {
        return view('admin.tutorials.show', compact('tutorial'));
    }

    public function edit(Tutorial $tutorial)
    {
        $categories = Category::all();
        return view('admin.tutorials.edit', compact('tutorial', 'categories'));
    }

    public function update(Request $request, Tutorial $tutorial)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $tutorial->update($validated);
        
        return redirect()->route('admin.tutorials.index')->with('success', 'Tutorial updated successfully.');
    }

    public function destroy(Tutorial $tutorial)
    {
        $tutorial->delete();
        return redirect()->route('admin.tutorials.index')->with('success', 'Tutorial deleted successfully.');
    }
}

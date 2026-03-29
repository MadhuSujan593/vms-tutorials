<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tutorial;
use App\Models\Category;

class TutorialController extends Controller
{
    public function index(Category $category)
    {
        $tutorials = $category->tutorials()
                              ->whereNull('parent_id')
                              ->with('children')
                              ->orderBy('sort_order')
                              ->get();
                              
        return view('admin.tutorials.index', compact('tutorials', 'category'));
    }

    public function create(Category $category)
    {
        $parents = $category->tutorials()->whereNull('parent_id')->orderBy('sort_order')->get();
        return view('admin.tutorials.create', compact('category', 'parents'));
    }

    public function store(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:tutorials,id'
        ]);

        $validated['category_id'] = $category->id;
        $validated['is_published'] = $request->boolean('is_published');
        
        // Set sort order to the end of the specific level
        $maxOrder = Tutorial::where('category_id', $category->id)
                            ->where('parent_id', $request->parent_id)
                            ->max('sort_order');
        $validated['sort_order'] = $maxOrder !== null ? $maxOrder + 1 : 0;

        Tutorial::create($validated);
        
        return redirect()->route('admin.categories.tutorials.index', $category)->with('success', 'Tutorial created successfully.');
    }

    public function show(Category $category, Tutorial $tutorial)
    {
        return view('admin.tutorials.show', compact('category', 'tutorial'));
    }

    public function edit(Category $category, Tutorial $tutorial)
    {
        $parents = $category->tutorials()
                            ->whereNull('parent_id')
                            ->where('id', '!=', $tutorial->id)
                            ->orderBy('sort_order')
                            ->get();
        return view('admin.tutorials.edit', compact('category', 'tutorial', 'parents'));
    }

    public function update(Request $request, Category $category, Tutorial $tutorial)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:tutorials,id'
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $tutorial->update($validated);
        
        return redirect()->route('admin.categories.tutorials.index', $category)->with('success', 'Tutorial updated successfully.');
    }

    public function destroy(Category $category, Tutorial $tutorial)
    {
        $tutorial->delete();
        return redirect()->route('admin.categories.tutorials.index', $category)->with('success', 'Tutorial deleted successfully.');
    }

    public function reorder(Request $request, Category $category)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tutorials,id'
        ]);

        foreach ($request->ids as $index => $id) {
            Tutorial::where('id', $id)
                    ->where('category_id', $category->id)
                    ->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}

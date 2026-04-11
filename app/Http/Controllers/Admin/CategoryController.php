<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categoriesList = Category::orderBy('name')->get();
        return view('admin.categories.create', compact('categoriesList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'related_categories' => 'nullable|array',
            'related_categories.*' => 'exists:categories,id',
        ]);
        
        $validated['is_blog'] = $request->boolean('is_blog');
        
        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('categories', 'public');
        }
        
        $category = Category::create($validated);
        $this->syncRelatedCategories($category, $request->get('related_categories', []));
        
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categoriesList = Category::where('id', '!=', $category->id)->orderBy('name')->get();
        return view('admin.categories.edit', compact('category', 'categoriesList'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'related_categories' => 'nullable|array',
            'related_categories.*' => 'exists:categories,id',
        ]);

        $validated['is_blog'] = $request->boolean('is_blog');

        if ($request->hasFile('icon')) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $validated['icon'] = $request->file('icon')->store('categories', 'public');
        }

        $category->update($validated);
        $this->syncRelatedCategories($category, $request->get('related_categories', []));
        
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }
        $category->delete();
        \DB::table('related_categories')->where('related_id', $category->id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    private function syncRelatedCategories(Category $category, array $relatedIds)
    {
        $category->relatedCategories()->sync($relatedIds);
        
        \DB::table('related_categories')
            ->where('related_id', $category->id)
            ->whereNotIn('category_id', $relatedIds)
            ->delete();
            
        foreach ($relatedIds as $id) {
            \DB::table('related_categories')->updateOrInsert(
                ['category_id' => $id, 'related_id' => $category->id],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}

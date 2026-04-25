<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'parent_id' => 'nullable|exists:tutorials,id',
            'quizzes' => 'nullable|array',
            'quizzes.*.question' => 'required_with:quizzes|string',
            'quizzes.*.option_a' => 'required_with:quizzes.*.question|string',
            'quizzes.*.option_b' => 'required_with:quizzes.*.question|string',
            'quizzes.*.correct_answer' => 'required_with:quizzes.*.question|in:a,b,c,d',
        ]);

        $validated['category_id'] = $category->id;
        $validated['is_published'] = $request->boolean('is_published');
        
        // Set sort order to the end of the specific level
        $maxOrder = Tutorial::where('category_id', $category->id)
                            ->where('parent_id', $request->parent_id)
                            ->max('sort_order');
        $validated['sort_order'] = $maxOrder !== null ? $maxOrder + 1 : 0;

        $tutorial = Tutorial::create($validated);

        // Handle Quiz Questions
        if ($request->has('quizzes')) {
            foreach ($request->quizzes as $index => $quizData) {
                if (!empty($quizData['question'])) {
                    $tutorial->quizQuestions()->create([
                        'question' => $quizData['question'],
                        'option_a' => $quizData['option_a'],
                        'option_b' => $quizData['option_b'],
                        'option_c' => $quizData['option_c'],
                        'option_d' => $quizData['option_d'],
                        'correct_answer' => $quizData['correct_answer'],
                        'explanation' => $quizData['explanation'],
                        'sort_order' => $index,
                    ]);
                }
            }
        }
        
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
            'parent_id' => 'nullable|exists:tutorials,id',
            'quizzes' => 'nullable|array',
            'quizzes.*.id' => 'nullable|exists:quiz_questions,id',
            'quizzes.*.question' => 'required_with:quizzes|string',
            'quizzes.*.option_a' => 'required_with:quizzes.*.question|string',
            'quizzes.*.option_b' => 'required_with:quizzes.*.question|string',
            'quizzes.*.correct_answer' => 'required_with:quizzes.*.question|in:a,b,c,d',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $tutorial->update($validated);

        // Handle Quiz Questions
        $quizIds = [];
        if ($request->has('quizzes')) {
            foreach ($request->quizzes as $index => $quizData) {
                if (!empty($quizData['question'])) {
                    $quiz = $tutorial->quizQuestions()->updateOrCreate(
                        ['id' => $quizData['id'] ?? null],
                        [
                            'question' => $quizData['question'],
                            'option_a' => $quizData['option_a'],
                            'option_b' => $quizData['option_b'],
                            'option_c' => $quizData['option_c'],
                            'option_d' => $quizData['option_d'],
                            'correct_answer' => $quizData['correct_answer'],
                            'explanation' => $quizData['explanation'],
                            'sort_order' => $index,
                        ]
                    );
                    $quizIds[] = $quiz->id;
                }
            }
        }
        // Delete removed questions
        $tutorial->quizQuestions()->whereNotIn('id', $quizIds)->delete();
        
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
    
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tutorial_images', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}

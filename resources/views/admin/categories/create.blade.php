<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.categories.index') }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                &larr; Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Category') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-sm" value="{{ old('name') }}" placeholder="e.g. Python">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="mb-4">
                            <label for="icon" class="block text-sm font-medium text-gray-700">Category Icon (Logo) <span class="text-xs text-gray-500 font-normal">(Max 5MB)</span></label>
                            <input type="file" name="icon" id="icon" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('icon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-sm" placeholder="Brief description about this category...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Practice Test Link -->
                        <div class="mb-6">
                            <label for="practice_test_link" class="block text-sm font-medium text-gray-700">Practice Test/Quiz Link (Optional)</label>
                            <input type="url" name="practice_test_link" id="practice_test_link" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 sm:text-sm" value="{{ old('practice_test_link') }}" placeholder="https://vms-tutorials.com/quizzes/python-advanced">
                            <p class="text-xs text-gray-500 mt-1">If provided, this link will be shown to users after they complete a tutorial quiz.</p>
                            @error('practice_test_link')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Blog Post Category Toggle -->
                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="is_blog" id="is_blog" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ old('is_blog') ? 'checked' : '' }}>
                            <label for="is_blog" class="ml-2 block text-sm font-medium text-gray-900">
                                This is a Blog Category
                                <p class="text-xs text-gray-500 font-normal">If checked, it will bypass structured sidebars and show on the top Navbar instead.</p>
                            </label>
                        </div>

                        <!-- Related Categories -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Related Categories (Many-to-Many Vise-Versa)</label>
                            <div class="space-y-2 border border-gray-300 rounded-md p-4 max-h-48 overflow-y-auto bg-gray-50">
                                @forelse($categoriesList as $cat)
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input type="checkbox" name="related_categories[]" id="related_{{ $cat->id }}" value="{{ $cat->id }}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ (collect(old('related_categories'))->contains($cat->id)) ? 'checked' : '' }}>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="related_{{ $cat->id }}" class="font-medium text-gray-700">{{ $cat->name }}</label>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No other categories available.</p>
                                @endforelse
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Linking here will also link the other category back to this one automatically.</p>
                            @error('related_categories')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none">
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

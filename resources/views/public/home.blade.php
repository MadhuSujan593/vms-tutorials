<x-public-layout>
    <div class="relative py-24 sm:py-32 overflow-hidden bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <!-- Abstract Background Gradients -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-6xl mb-6">
                Master Modern <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-500">Technology</span>
            </h1>
            <p class="mt-4 text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Step-by-step professional tutorials to elevate your coding skills. From backend logic to frontend brilliance.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($categories as $category)
                <a href="{{ route('public.category', $category) }}" class="group relative bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <!-- Hover Accent -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    
                    <div>
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-indigo-600/30">
                            <!-- Icon Placeholder - Letter of Category -->
                            <span class="text-2xl font-bold uppercase">{{ substr($category->name, 0, 1) }}</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6">
                            {{ $category->description ?? 'Explore comprehensive tutorials and guides for '.$category->name.'.' }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                            {{ $category->tutorials_count }} Topics
                        </span>
                        <div class="text-indigo-600 dark:text-indigo-400 group-hover:translate-x-2 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500 text-lg">No categories available yet. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-public-layout>

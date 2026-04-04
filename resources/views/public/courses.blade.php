<x-public-layout>
    <x-slot name="title">Our Courses | VMS Tutorials</x-slot>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-8 sm:pt-12 pb-16 sm:pb-24">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-xs font-medium" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                <li class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                    <span class="text-gray-400">Courses</span>
                </li>
            </ol>
        </nav>

        <header class="mb-12">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                Our Courses
            </h1>
            <div class="h-1 w-16 bg-indigo-600 rounded-full mb-6"></div>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl leading-relaxed">
                Step-by-step professional courses to elevate your coding skills. Master backend logic and frontend brilliance with industry-standard guides.
            </p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($courses as $course)
                <a href="{{ $course->redirect_url }}" target="_blank" class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500/50 hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden">
                    <div class="aspect-video relative overflow-hidden bg-gray-100 dark:bg-gray-900">
                        <img src="{{ asset('storage/' . $course->image_path) }}" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-1.5 py-0.5 bg-indigo-50 dark:bg-indigo-900/40 text-[9px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest rounded">Course</span>
                            @if($course->is_active)
                                <span class="px-1.5 py-0.5 bg-emerald-50 dark:bg-emerald-900/40 text-[9px] font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-widest rounded">Enrolling</span>
                            @endif
                        </div>
                        
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors leading-tight">
                            {{ $course->title }}
                        </h3>
                        
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed line-clamp-2 mb-4 flex-grow">
                            Master modern web development with this comprehensive course. Build real-world projects and scale your expertise.
                        </p>
                        
                        <div class="pt-4 border-t border-gray-50 dark:border-gray-700/50 flex items-center justify-between">
                            <span class="text-[10px] font-semibold text-gray-400 uppercase">Self-Paced</span>
                            <span class="text-indigo-600 dark:text-indigo-400 text-xs font-bold flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                Enroll
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="mx-auto w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">No courses available yet. Please check back later!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $courses->links() }}
        </div>
    </div>
</x-public-layout>

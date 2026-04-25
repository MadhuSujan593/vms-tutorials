<x-public-layout>
    <x-slot name="title">{{ $tutorial->title }} - {{ $category->name }} | VMS Tutorials</x-slot>


    @if(!$category->is_blog)
        @push('mobile_sidebar')
            @include('public.partials.tutorial_nav', ['navItems' => $allTutorials])
        @endpush
    @endif

    <!-- Page Specific Structured Data -->
    @push('schema')
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "{{ $category->name }}",
            "item": "{{ route('public.category', $category) }}"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $tutorial->title }}",
            "item": "{{ url()->current() }}"
        }]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TechArticle",
        "headline": "{{ $tutorial->title }}",
        "description": "{{ $metaDescription }}",
        "author": {
            "@type": "Organization",
            "name": "VMS Tutorials"
        },
        "publisher": {
            "@type": "Organization",
            "name": "VMS Tutorials",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('img/logo.png') }}"
            }
        },
        "datePublished": "{{ $tutorial->created_at->toIso8601String() }}",
        "dateModified": "{{ $tutorial->updated_at->toIso8601String() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url()->current() }}"
        }
    }
    </script>
    @endpush

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            @if(!$category->is_blog)
                <!-- Left Sidebar (Desktop Only) -->
                <aside class="hidden lg:block w-64 flex-shrink-0 sticky top-32 h-[calc(100vh-8rem)] overflow-y-auto pb-10 border-r border-gray-100 dark:border-gray-800 pr-4 custom-scrollbar">
                    @include('public.partials.tutorial_nav', ['navItems' => $allTutorials])
                </aside>
            @endif

            <!-- Main Content Area -->
            <main class="flex-1 min-w-0 py-6 lg:py-10">
                <!-- Breadcrumbs -->
                <nav class="flex mb-6 text-xs font-medium" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                            <a href="{{ route('public.category', $category) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">{{ $category->name }}</a>
                        </li>
                    </ol>
                </nav>

                <article>
                    <header class="mb-8">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-3">
                            {{ $tutorial->title }}
                        </h1>
                        <div class="h-1 w-16 bg-indigo-600 rounded-full"></div>
                    </header>

                    <div class="relative">
                        <x-markdown :content="$tutorial->content" />
                    </div>
                </article>

                <!-- Quiz Section -->
                @if($tutorial->quizQuestions->count() > 0)
                <div class="mt-24 pt-16 border-t border-gray-100 dark:border-gray-800" id="tutorial-quiz">
                    <div class="max-w-3xl mx-auto">
                        <div class="text-center mb-16">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight mb-3">Knowledge check</h2>
                            <p class="text-gray-500 dark:text-gray-400">Validate your understanding of this tutorial</p>
                        </div>

                        <div class="space-y-16">
                            @foreach($tutorial->quizQuestions as $quiz)
                            <div class="relative" 
                                 x-data="{ 
                                    selected: null, 
                                    answered: false, 
                                    correct: @js($quiz->correct_answer),
                                    isCorrect() { return this.selected === this.correct }
                                 }">
                                
                                <div class="relative">
                                    <!-- Question Label -->
                                    <div class="flex items-center gap-3 mb-6">
                                        <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest bg-indigo-50 dark:bg-indigo-900/30 px-3 py-1 rounded-full">Question {{ $loop->iteration }}</span>
                                    </div>

                                    <h3 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white leading-snug mb-10">
                                        {{ $quiz->question }}
                                    </h3>

                                    <div class="space-y-3">
                                        @foreach(['a', 'b', 'c', 'd'] as $opt)
                                            @if($quiz->{'option_'.$opt})
                                                <button 
                                                    @click="if(!answered) { selected = '{{ $opt }}'; answered = true; }"
                                                    class="group relative w-full text-left px-6 py-5 rounded-2xl border transition-all duration-200 flex items-center justify-between"
                                                    :class="{
                                                        'border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 hover:border-gray-300 dark:hover:border-gray-600 hover:shadow-sm': !answered,
                                                        'border-green-500 bg-green-50/30 dark:bg-green-900/10': answered && '{{ $opt }}' === correct,
                                                        'border-red-500 bg-red-50/30 dark:bg-red-900/10': answered && selected === '{{ $opt }}' && '{{ $opt }}' !== correct,
                                                        'opacity-50 grayscale-[0.5]': answered && selected !== '{{ $opt }}' && '{{ $opt }}' !== correct
                                                    }"
                                                    :disabled="answered"
                                                >
                                                    <div class="flex items-center gap-4">
                                                        <span class="text-sm font-bold w-6 h-6 flex items-center justify-center rounded-md transition-colors"
                                                            :class="{
                                                                'bg-gray-100 dark:bg-gray-800 text-gray-400 group-hover:bg-gray-200': !answered,
                                                                'bg-green-500 text-white': answered && '{{ $opt }}' === correct,
                                                                'bg-red-500 text-white': answered && selected === '{{ $opt }}' && '{{ $opt }}' !== correct,
                                                                'bg-gray-100 dark:bg-gray-800 text-gray-400': answered && selected !== '{{ $opt }}' && '{{ $opt }}' !== correct
                                                            }">
                                                            {{ strtoupper($opt) }}
                                                        </span>
                                                        <span class="text-base font-medium tracking-tight text-gray-800 dark:text-gray-200">
                                                            {{ $quiz->{'option_'.$opt} }}
                                                        </span>
                                                    </div>

                                                    <div x-show="answered && ('{{ $opt }}' === correct || selected === '{{ $opt }}')">
                                                        <template x-if="'{{ $opt }}' === correct">
                                                            <svg class="w-5 h-5 text-green-600 animate-bounce-in" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                                        </template>
                                                        <template x-if="selected === '{{ $opt }}' && '{{ $opt }}' !== correct">
                                                            <svg class="w-5 h-5 text-red-600 animate-shake" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </template>
                                                    </div>
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Clean Explanation -->
                                    <div x-show="answered" 
                                         x-transition:enter="transition-all duration-300"
                                         x-transition:enter-start="opacity-0 translate-y-3"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         class="mt-8">
                                        <div class="p-6 rounded-2xl" :class="isCorrect() ? 'bg-green-50/50 dark:bg-green-900/10' : 'bg-gray-50 dark:bg-gray-800/50'">
                                            <div class="flex items-start gap-4">
                                                <div class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 mt-0.5" 
                                                     :class="isCorrect() ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500'">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold mb-1" :class="isCorrect() ? 'text-green-900 dark:text-green-100' : 'text-gray-900 dark:text-gray-100'">
                                                        <template x-if="isCorrect()">Correct</template>
                                                        <template x-if="!isCorrect()">Explanation</template>
                                                    </p>
                                                    <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400 font-medium">
                                                        {{ $quiz->explanation }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Navigation between topics -->
                <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                    @php
                        $currentIndex = $flattenedTutorials->search(fn($t) => $t->id === $tutorial->id);
                        $prev = $currentIndex > 0 ? $flattenedTutorials->get($currentIndex - 1) : null;
                        $next = $currentIndex < $flattenedTutorials->count() - 1 ? $flattenedTutorials->get($currentIndex + 1) : null;
                    @endphp

                    @if($prev)
                        <a href="{{ route('public.tutorial', [$category->slug, $prev->slug]) }}" class="group flex-1 p-4 rounded-xl bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-800/30 hover:border-blue-300 dark:hover:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all shadow-sm flex flex-col items-start gap-1">
                            <span class="text-[10px] font-bold text-blue-500 dark:text-blue-400 uppercase tracking-widest">Previous Topic</span>
                            <span class="text-sm font-bold text-blue-900 dark:text-blue-100 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                {{ $prev->title }}
                            </span>
                        </a>
                    @endif

                    @if($next)
                        <a href="{{ route('public.tutorial', [$category->slug, $next->slug]) }}" class="group flex-1 p-4 rounded-xl bg-indigo-50/50 dark:bg-indigo-900/10 border border-indigo-100 dark:border-indigo-800/30 hover:border-indigo-300 dark:hover:border-indigo-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all shadow-sm flex flex-col items-end gap-1 text-right">
                            <span class="text-[10px] font-bold text-indigo-500 dark:text-indigo-400 uppercase tracking-widest">Next Topic</span>
                            <span class="text-sm font-bold text-indigo-900 dark:text-indigo-100 group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors flex items-center gap-2">
                                {{ $next->title }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </a>
                    @endif
                </div>

                <!-- Related Categories -->
                @if($category->relatedCategories->count() > 0)
                    <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-800">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Related Topics You Might Like</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($category->relatedCategories as $related)
                                <a href="{{ route('public.category', $related->slug) }}" class="group block p-5 rounded-2xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 hover:shadow-md transition-all">
                                    <div class="flex items-center gap-3">
                                        @if($related->icon)
                                            <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center p-2 flex-shrink-0 shadow-sm border border-indigo-100 dark:border-indigo-800/50">
                                                <img src="{{ asset('storage/' . $related->icon) }}" class="w-full h-full object-contain filter drop-shadow-sm" alt="{{ $related->name }}">
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">{{ $related->name }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1">{{ $related->description ?? 'Explore related tutorials.' }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Mobile Banner -->
                <div class="mt-12 xl:hidden flex justify-center">
                    <div class="w-full max-w-xs">
                        @include('public.partials.banner', ['banners' => $banners, 'aspect' => '2/3'])
                    </div>
                </div>
            </main>

            <!-- Right Sidebar (TOC) -->
            <aside class="hidden xl:block w-72 flex-shrink-0 sticky top-32 h-[calc(100vh-8rem)] overflow-y-auto mt-10 py-10 pl-6 border-l border-gray-50 dark:border-gray-800 custom-scrollbar">
                <nav class="space-y-4">
                    <h5 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">On this page</h5>
                    <ul class="space-y-2 text-xs font-medium">
                        <li>
                            <a href="#" class="block text-indigo-600 dark:text-indigo-400">Overview</a>
                        </li>
                        <!-- This part is dynamic via the component's TOC -->
                        @php $md = new \App\View\Components\Markdown($tutorial->content); @endphp
                        @foreach($md->toc as $item)
                            <li>
                                <a href="#{{ $item['slug'] }}" 
                                   class="block {{ $item['tag'] === 'h3' ? 'pl-3' : '' }} text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                    {{ $item['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>

                <div class="mt-12 px-4">
                    @include('public.partials.banner', ['banners' => $banners, 'aspect' => '2/3'])
                </div>
            </aside>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #1e293b;
        }
        html {
            scroll-behavior: smooth;
        }

        /* Quiz Animations */
        @keyframes bounce-in {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-bounce-in {
            animation: bounce-in 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) both;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }
        .animate-shake {
            animation: shake 0.4s ease-in-out both;
        }
    </style>
</x-public-layout>

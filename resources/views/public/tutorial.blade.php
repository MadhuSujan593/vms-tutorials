<x-public-layout>
    <x-slot name="title">{{ $tutorial->title }} - {{ $category->name }} | VMS Tutorials</x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Sidebar (Topic List) - W3Schools Style -->
            <aside class="w-full lg:w-64 flex-shrink-0 lg:sticky lg:top-24 lg:h-[calc(100vh-6rem)] overflow-y-auto pb-10 border-r border-gray-100 dark:border-gray-800 pr-4 custom-scrollbar">
                <div class="mb-8">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">
                        {{ $category->name }} Tutorials
                    </h3>
                    <nav class="space-y-1" x-data="{ openSection: @json($tutorial->parent_id ?? $tutorial->id) }">
                        @foreach($allTutorials as $item)
                            <div class="relative">
                                @php 
                                    $hasChildren = $item->children->count() > 0;
                                    $isActiveParent = ($tutorial->id === $item->id || $tutorial->parent_id === $item->id);
                                    $linkTarget = $hasChildren ? $item->children->first() : $item;
                                @endphp

                                <div class="flex items-center group">
                                    <a href="{{ route('public.tutorial', [$category->slug, $linkTarget->slug]) }}" 
                                       @click="openSection = {{ $item->id }}"
                                       class="flex-1 group flex items-center justify-between px-3 py-2 text-sm font-bold rounded-xl transition-all duration-200 
                                       {{ $isActiveParent
                                          ? 'bg-indigo-600/10 text-indigo-600 dark:text-indigo-400' 
                                          : 'text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                                        <span class="truncate">{{ $item->title }}</span>
                                        
                                        @if($hasChildren)
                                            <svg @click.prevent.stop="openSection = (openSection === {{ $item->id }} ? null : {{ $item->id }})" 
                                                 class="w-4 h-4 transition-transform duration-200" 
                                                 :class="openSection === {{ $item->id }} ? 'rotate-180' : ''"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        @endif
                                    </a>
                                </div>

                                @if($hasChildren)
                                    <div x-show="openSection === {{ $item->id }}" 
                                         x-transition:enter="transition ease-out duration-100"
                                         x-transition:enter-start="opacity-0 -translate-y-2"
                                         x-transition:enter-end="opacity-100 translate-y-0"
                                         class="mt-1 space-y-1 pl-4 border-l-2 border-gray-100 dark:border-gray-800 ml-3">
                                        @foreach($item->children as $child)
                                            <a href="{{ route('public.tutorial', [$category->slug, $child->slug]) }}" 
                                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl transition-all duration-200 
                                               {{ $tutorial->id === $child->id 
                                                  ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30' 
                                                  : 'text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                                                <span class="truncate">{{ $child->title }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 min-w-0 py-8 lg:py-12">
                <!-- Breadcrumbs -->
                <nav class="flex mb-8 text-sm font-medium" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                            <a href="{{ route('public.category', $category) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">{{ $category->name }}</a>
                        </li>
                    </ol>
                </nav>

                <article>
                    <header class="mb-12">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                            {{ $tutorial->title }}
                        </h1>
                        <div class="h-1.5 w-20 bg-indigo-600 rounded-full"></div>
                    </header>

                    <div class="relative">
                        <x-markdown :content="$tutorial->content" />
                    </div>
                </article>

                <!-- Navigation between topics -->
                <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center gap-4">
                    @php
                        $currentIndex = $flattenedTutorials->search(fn($t) => $t->id === $tutorial->id);
                        $prev = $currentIndex > 0 ? $flattenedTutorials->get($currentIndex - 1) : null;
                        $next = $currentIndex < $flattenedTutorials->count() - 1 ? $flattenedTutorials->get($currentIndex + 1) : null;
                    @endphp

                    @if($prev)
                        <a href="{{ route('public.tutorial', [$category->slug, $prev->slug]) }}" class="group flex-1 p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all shadow-sm flex flex-col items-start gap-1">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Previous Topic</span>
                            <span class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                {{ $prev->title }}
                            </span>
                        </a>
                    @else
                        <div class="flex-1"></div>
                    @endif

                    @if($next)
                        <a href="{{ route('public.tutorial', [$category->slug, $next->slug]) }}" class="group flex-1 p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all shadow-sm flex flex-col items-end gap-1 text-right">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Next Topic</span>
                            <span class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                {{ $next->title }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </a>
                    @else
                        <div class="flex-1"></div>
                    @endif
                </div>
            </main>

            <!-- Right Sidebar (TOC) -->
            <aside class="hidden xl:block w-64 flex-shrink-0 sticky top-24 h-[calc(100vh-6rem)] overflow-y-auto mt-12 py-12 pl-8 border-l border-gray-50 dark:border-gray-800">
                <nav class="space-y-4">
                    <h5 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-6">On this page</h5>
                    <ul class="space-y-4 text-sm font-medium">
                        <li>
                            <a href="#" class="block text-indigo-600 dark:text-indigo-400">Overview</a>
                        </li>
                        <!-- This part is dynamic via the component's TOC -->
                        @php $md = new \App\View\Components\Markdown($tutorial->content); @endphp
                        @foreach($md->toc as $item)
                            <li>
                                <a href="#{{ $item['slug'] }}" 
                                   class="block {{ $item['tag'] === 'h3' ? 'pl-4' : '' }} text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                    {{ $item['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
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
    </style>
</x-public-layout>

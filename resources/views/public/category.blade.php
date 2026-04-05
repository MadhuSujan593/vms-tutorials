<x-public-layout>

    @push('mobile_sidebar')
        @include('public.partials.tutorial_nav', ['navItems' => $tutorials])
    @endpush

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
            "item": "{{ url()->current() }}"
        }]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "{{ $category->name }} Tutorials",
        "description": "{{ $metaDescription }}",
        "publisher": {
            "@type": "Organization",
            "name": "VMS Tutorials"
        }
    }
    </script>
    @endpush
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-8 sm:pt-12 pb-16 sm:pb-24">
        <div class="mb-12">
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500 transition-colors">
                                <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                                <span class="sr-only">Home</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <span class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white sm:text-3xl mb-4">
                {{ $category->name }} Tutorials
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl">
                Explore our collection of {{ $category->name }} topics. Master each concept with step-by-step guides and practical examples.
            </p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tutorials as $tutorial)
                <a href="{{ route('public.tutorial', [$category->slug, $tutorial->slug]) }}" class="group bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500/50 hover:shadow-md transition-all flex items-center gap-3">
                    <div class="w-8 h-8 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 overflow-hidden">
                        @if($category->icon)
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }} icon" class="w-full h-full object-cover">
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $tutorial->title }}
                        </h4>
                        <span class="text-xs text-gray-500 uppercase tracking-wider">Read Tutorial &rarr;</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-12 text-center">
                    <p class="text-gray-500">No tutorials found for this category yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-public-layout>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true',
        mobileMenuOpen: false 
      }" 
      :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="google-site-verification" content="xy01iEd-OOBG7hS6v4oZpuyBrwoH53D7gXqr4tPeZDk" />

        <!-- Prevent Flash of Light Mode -->
        <script>
            if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Branding & SEO -->
        <meta name="theme-color" content="#4f46e5">
        <title>{{ $title ?? config('app.name', 'VMS Tutorials') }}</title>
        
        <meta name="description" content="{{ $metaDescription ?? 'Master modern technology with step-by-step professional coding tutorials for PHP, Java, JavaScript, and more. Master backend logic and frontend brilliance with industry-standard guides.' }}">
        <meta name="keywords" content="coding tutorials, programming guides, learn PHP, Java mastered, JavaScript tutorials, Laravel developer, web development training, VMS Tutorials, consultant projects">
        
        <link rel="canonical" href="{{ url()->current() }}">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $title ?? 'VMS Tutorials - Master Modern Technology' }}">
        <meta property="og:description" content="{{ $metaDescription ?? 'Step-by-step professional coding tutorials for PHP, Java, JavaScript, and more. Master backend logic and frontend brilliance.' }}">
        <meta property="og:image" content="{{ asset('img/logo.png') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $title ?? 'VMS Tutorials - Master Modern Technology' }}">
        <meta property="twitter:description" content="{{ $metaDescription ?? 'Step-by-step professional coding tutorials for PHP, Java, JavaScript, and more.' }}">
        <meta property="twitter:image" content="{{ asset('img/logo.png') }}">

        @stack('meta')

        <!-- Structured Data (JSON-LD) - Organization -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "VMS Tutorials",
            "alternatename": "VMS Consultix",
            "url": "{{ url('/') }}",
            "logo": "{{ asset('img/logo.png') }}",
            "description": "Professional coding tutorials and technology consultant projects.",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+91-9000621876",
                "contactType": "Customer Support",
                "email": "contact@vmsclass.com"
            }
        }
        </script>
        @stack('schema')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Favicon (VMS Branding) -->
        <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%234f46e5%22/><text x=%2250%%22 y=%2250%%22 dominant-baseline=%22central%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-weight=%22bold%22 font-size=%2245%22 fill=%22white%22>VMS</text></svg>">

        <!-- Alpine Plugins (Must load before Alpine) -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- PrismJS Theme (Loaded after main CSS to ensure override) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
        
        <style>
            [x-cloak] { display: none !important; }
            .vms-markdown code[class*="language-"], 
            .vms-markdown pre[class*="language-"] {
                text-shadow: none !important;
            }
            /* Precision overrides to force Prism colors through Tailwind Prose */
            .vms-markdown .token.comment, .vms-markdown .token.prolog, .vms-markdown .token.doctype, .vms-markdown .token.cdata { color: #999 !important; }
            .vms-markdown .token.namespace { opacity: .7 !important; }
            .vms-markdown .token.property, .vms-markdown .token.tag, .vms-markdown .token.boolean, .vms-markdown .token.number, .vms-markdown .token.constant, .vms-markdown .token.symbol, .vms-markdown .token.deleted { color: #f92672 !important; }
            .vms-markdown .token.selector, .vms-markdown .token.attr-name, .vms-markdown .token.string, .vms-markdown .token.char, .vms-markdown .token.builtin, .vms-markdown .token.inserted { color: #a6e22e !important; }
            .vms-markdown .token.operator, .vms-markdown .token.entity, .vms-markdown .token.url, .language-css .token.string, .style .token.string { color: #f8f8f2 !important; }
            .vms-markdown .token.atrule, .vms-markdown .token.attr-value, .vms-markdown .token.keyword { color: #66d9ef !important; }
            .vms-markdown .token.function, .vms-markdown .token.class-name { color: #e6db74 !important; }
            .vms-markdown .token.regex, .vms-markdown .token.important, .vms-markdown .token.variable { color: #fd971f !important; }

            .glass {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            .dark .glass {
                background: rgba(17, 24, 39, 0.7);
            }
            .copy-btn {
                position: absolute;
                top: 12px;
                right: 12px;
                padding: 6px 12px;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 8px;
                color: #fff;
                cursor: pointer;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                transition: all 0.2s;
                opacity: 1;
                z-index: 10;
            }
            .copy-btn:hover {
                background: rgba(255, 255, 255, 0.2);
            }
            .copy-btn.copied {
                background: #10b981;
                border-color: #10b981;
                opacity: 1;
            }
            .prose table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            /* Smooth theme transition only after initial load */
            .theme-ready {
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 300ms;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-none theme-ready">
        
        <!-- Sticky Header -->
        <nav class="sticky top-0 z-50 glass border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-4">
                        <!-- Hamburger Menu (Mobile Only) -->
                        <button @click="mobileMenuOpen = true" 
                                class="lg:hidden p-2 -ml-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors focus:outline-none"
                                aria-label="Open navigation menu">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>

                        <a href="{{ route('home') }}" class="flex items-center gap-2 group text-2xl font-bold tracking-tighter">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded-lg group-hover:bg-indigo-500 transition-colors">VMS</span>
                            <span class="dark:text-white hidden sm:inline">Tutorials</span>
                        </a>
                    </div>

                        <div class="hidden sm:flex items-center gap-6 mr-6">
                            @foreach($allCategories->where('is_blog', true) as $blogCat)
                                <a href="{{ route('public.category', $blogCat->slug) }}" class="text-sm font-medium transition-all duration-300 {{ (request()->is('tutorials/' . $blogCat->slug) || request()->is('tutorials/' . $blogCat->slug . '/*')) ? 'text-indigo-600 dark:text-indigo-400 border-b-2 border-indigo-600' : 'text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                                    {{ $blogCat->name }}
                                </a>
                            @endforeach
                            <a href="{{ route('public.courses') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-300">Courses</a>
                            <a href="{{ route('public.about') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">About Us</a>
                            <a href="{{ route('public.contact') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Contact Us</a>
                            <a href="{{ route('public.donate') }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Donate</a>
                        </div>

                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all focus:outline-none"
                                title="Toggle Dark/Light Mode"
                                aria-label="Toggle visual theme">
                            <template x-if="!darkMode">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            </template>
                            <template x-if="darkMode">
                                <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M14 12a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </template>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Category Sticky Sub-Nav (W3Schools Style) -->
        <div class="sticky top-16 z-40 bg-gray-900 border-b border-gray-800 shadow-lg overflow-hidden transition-all duration-300" 
             x-data="{ 
                canScrollLeft: false, 
                canScrollRight: false,
                checkScroll() {
                    const el = this.$refs.scrollContainer;
                    if (!el) return;
                    this.canScrollLeft = el.scrollLeft > 5;
                    this.canScrollRight = el.scrollLeft < (el.scrollWidth - el.clientWidth - 5);
                },
                scroll(amount) {
                    this.$refs.scrollContainer.scrollBy({ left: amount, behavior: 'smooth' });
                }
             }"
             x-init="setTimeout(() => checkScroll(), 200); window.addEventListener('resize', () => checkScroll())">
            <div class="max-w-7xl mx-auto relative group">
                <!-- Left Scroll Button -->
                <button @click="scroll(-300)" 
                        x-show="canScrollLeft"
                        x-cloak
                        class="absolute left-0 top-0 bottom-0 z-10 w-12 bg-gradient-to-r from-gray-900 to-transparent text-white flex items-center justify-start pl-2 hover:text-indigo-400 transition-colors">
                    <svg class="w-6 h-6 shadow-2xl" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                </button>

                <!-- Scroll Container -->
                <div x-ref="scrollContainer" 
                     @scroll.debounce.50ms="checkScroll()"
                     class="flex items-center gap-0 overflow-x-auto no-scrollbar scroll-smooth">
                    
                    <a href="{{ route('home') }}" 
                       class="flex-shrink-0 px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] border-b-2 transition-all {{ request()->routeIs('home') ? 'bg-indigo-600 text-white border-indigo-600' : 'text-gray-400 border-transparent hover:text-white hover:bg-gray-800' }}">
                       Home
                    </a>

                    @foreach($allCategories->where('is_blog', false) as $cat)
                        <a href="{{ route('public.category', $cat->slug) }}" 
                           class="flex-shrink-0 px-6 py-4 text-[11px] font-black uppercase tracking-[0.2em] border-b-2 transition-all {{ (request()->is('tutorials/' . $cat->slug) || request()->is('tutorials/' . $cat->slug . '/*')) ? 'bg-indigo-600 text-white border-indigo-600' : 'text-gray-400 border-transparent hover:text-white hover:bg-gray-800' }}">
                           {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Right Scroll Button -->
                <button @click="scroll(300)" 
                        x-show="canScrollRight"
                        x-cloak
                        class="absolute right-0 top-0 bottom-0 z-10 w-12 bg-gradient-to-l from-gray-900 to-transparent text-white flex items-center justify-end pr-2 hover:text-indigo-400 transition-colors">
                    <svg class="w-6 h-6 shadow-2xl" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>

        <style>
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
        
        <!-- Mobile Sidebar Drawer -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             class="fixed inset-0 z-[60] lg:hidden" 
             role="dialog" aria-modal="true">
            <!-- Backdrop -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition-opacity ease-linear duration-300" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 @click="mobileMenuOpen = false"
                 class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm"></div>

            <div class="fixed inset-y-0 left-0 w-full max-w-xs flex">
                <div x-show="mobileMenuOpen" 
                     x-transition:enter="transition ease-in-out duration-300 transform" 
                     x-transition:enter-start="-translate-x-full" 
                     x-transition:enter-end="translate-x-0" 
                     x-transition:leave="transition ease-in-out duration-300 transform" 
                     x-transition:leave-start="translate-x-0" 
                     x-transition:leave-end="-translate-x-full" 
                     class="relative flex-1 flex flex-col w-full bg-white dark:bg-gray-900 shadow-2xl"
                     @click.away="mobileMenuOpen = false">
                    
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto custom-scrollbar">
                        <div class="flex-shrink-0 flex items-center justify-between px-4 mb-8">
                            <div class="flex items-center gap-2 text-xl font-bold tracking-tighter">
                                <span class="bg-indigo-600 text-white px-2 py-1 rounded-lg">VMS</span>
                                <span class="dark:text-white">Tutorials</span>
                            </div>
                            <button @click="mobileMenuOpen = false" 
                                    class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors focus:outline-none"
                                    aria-label="Close navigation menu">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        <nav class="mt-5 px-4 space-y-1">
                                @foreach($allCategories->where('is_blog', true) as $blogCat)
                                    <a href="{{ route('public.category', $blogCat->slug) }}" @click="mobileMenuOpen = false" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">{{ $blogCat->name }}</a>
                                @endforeach
                                <a href="{{ route('public.courses') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Courses</a>
                                <a href="{{ route('public.about') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">About Us</a>
                                <a href="{{ route('public.contact') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Contact Us</a>
                                <a href="{{ route('public.donate') }}" @click="mobileMenuOpen = false" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">Donate</a>
                            @stack('mobile_sidebar')
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <main class="min-h-screen">
            {{ $slot }}
        </main>

        <!-- Dynamic Footer -->
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 py-10 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex flex-col items-center gap-4">
                    <div class="flex items-center gap-2 text-xl font-bold tracking-tighter">
                        <span class="bg-indigo-600 text-white px-2 py-1 rounded-lg">VMS</span>
                        <span class="dark:text-white">Tutorials</span>
                    </div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        &copy; {{ date('Y') }} VMS Tutorials. All rights reserved. 
                        <span class="mx-2 text-gray-300 dark:text-gray-700">|</span> 
                        <a href="{{ route('public.donate') }}" class="hover:text-indigo-600 transition-colors underline decoration-indigo-200 dark:decoration-indigo-900 underline-offset-4">Support our mission</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- PrismJS Scripts (Best Practice: defer) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-java.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-python.min.js" defer></script>
        
        <script>
            // Initialize Syntax Highlighting and Copy Buttons
            function initCodeBlocks() {
                const preBlocks = document.querySelectorAll('pre:not(.has-copy-button)');
                if (preBlocks.length === 0) return;
                if (!window.Prism) return;

                preBlocks.forEach((pre) => {
                    pre.classList.add('has-copy-button');
                    const code = pre.querySelector('code');
                    const preLang = Array.from(pre.classList).find(c => c.startsWith('language-'));
                    
                    if (code && preLang) {
                        code.classList.add(preLang);
                    }

                    // Add Copy Button
                    const button = document.createElement('button');
                    button.className = 'copy-btn';
                    button.innerText = 'Copy';
                    button.onclick = () => {
                        const text = code ? code.innerText : pre.innerText;
                        navigator.clipboard.writeText(text).then(() => {
                            button.innerText = 'Copied!';
                            setTimeout(() => button.innerText = 'Copy', 2000);
                        });
                    };
                    
                    pre.style.position = 'relative';
                    pre.appendChild(button);
                });
                
                Prism.highlightAll();
            }

            window.addEventListener('load', initCodeBlocks);
            document.addEventListener('DOMContentLoaded', initCodeBlocks);
        </script>
    </body>
</html>

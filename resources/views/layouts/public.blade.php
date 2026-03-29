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
        
        <link rel="canonical" href="{{ url()->current() }}">
        
        @stack('meta')

        <!-- Structured Data (JSON-LD) - Organization -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "VMS Tutorials",
            "url": "{{ url('/') }}",
            "logo": "{{ asset('img/logo.png') }}",
            "description": "Professional coding tutorials for master developers."
        }
        </script>
        @stack('schema')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- PrismJS for Code Highlighting -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            [x-cloak] { display: none !important; }
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
                opacity: 0.4;
                z-index: 10;
            }
            pre:hover .copy-btn {
                opacity: 1;
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
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
        
        <!-- Sticky Header -->
        <nav class="sticky top-0 z-50 glass border-b border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-4">
                        <!-- Hamburger Menu (Mobile Only) -->
                        <button @click="mobileMenuOpen = true" class="lg:hidden p-2 -ml-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors focus:outline-none">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>

                        <a href="{{ route('home') }}" class="flex items-center gap-2 group text-2xl font-bold tracking-tighter">
                            <span class="bg-indigo-600 text-white px-2 py-1 rounded-lg group-hover:bg-indigo-500 transition-colors">VMS</span>
                            <span class="dark:text-white hidden sm:inline">Tutorials</span>
                        </a>
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Dark Mode Toggle -->
                        <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                                class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition-all focus:outline-none"
                                title="Toggle Dark/Light Mode">
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
                            <button @click="mobileMenuOpen = false" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors focus:outline-none">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        <nav x-data="{ openSection: @json(isset($tutorial) ? $tutorial->id : 0) }" class="mt-5 px-4 space-y-1">
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
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 py-12 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500">
                <p>&copy; {{ date('Y') }} VMS Tutorials. All rights reserved.</p>
            </div>
        </footer>

        <!-- PrismJS Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-java.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
        
        <script>
            // Initialize Copy Buttons
            function initCodeBlocks() {
                document.querySelectorAll('pre:not(.has-copy-button)').forEach((pre) => {
                    // Make pre relative for absolute positioning of the button
                    pre.classList.add('relative', 'has-copy-button');
                    
                    // Force a default language if none exists for better highlighting
                    const code = pre.querySelector('code');
                    if (code && !code.className.match(/language-/)) {
                        code.classList.add('language-javascript');
                    }

                    const button = document.createElement('button');
                    button.className = 'copy-btn';
                    button.innerText = 'Copy';
                    pre.appendChild(button);

                    button.addEventListener('click', () => {
                        const codeText = code ? code.innerText : pre.innerText;
                        navigator.clipboard.writeText(codeText).then(() => {
                            button.innerText = 'Copied!';
                            button.classList.add('copied');
                            
                            setTimeout(() => {
                                button.innerText = 'Copy';
                                button.classList.remove('copied');
                            }, 2000);
                        });
                    });
                });
                
                // Re-run Prism if it's available
                if (window.Prism) {
                    Prism.highlightAll();
                }
            }

            document.addEventListener('DOMContentLoaded', initCodeBlocks);
            // Also run it immediately in case DOM is already ready
            if (document.readyState === 'interactive' || document.readyState === 'complete') {
                initCodeBlocks();
            }
        </script>
    </body>
</html>

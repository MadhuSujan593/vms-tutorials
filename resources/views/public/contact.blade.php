<x-public-layout>
    <x-slot name="title">Contact Us | VMS Tutorials</x-slot>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-6 sm:pt-10 pb-24 text-center">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-12 text-xs font-medium justify-center text-center items-center" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                <li class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                    <span class="text-gray-400">Contact Us</span>
                </li>
            </ol>
        </nav>

        <header class="mb-16 max-w-2xl mx-auto">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                Get In Touch
            </h1>
            <div class="h-1 w-16 bg-indigo-600 rounded-full mb-8 mx-auto"></div>
            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed font-medium">
                Have a question about a tutorial or feedback on our content? We're here to help. Reach out to our team directly via email.
            </p>
        </header>

        <div class="max-w-2xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Email Card -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col items-center text-center gap-6 relative overflow-hidden h-full">
                <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.2em] mb-2">Email Us</h4>
                    <p class="text-lg font-black text-gray-900 dark:text-white break-all tracking-tight">contact@vmsclass.com</p>
                </div>
                <div class="mt-auto">
                    <a href="mailto:contact@vmsclass.com" class="inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-colors shadow-lg active:scale-95">
                        Send Email
                    </a>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col items-center text-center gap-6 relative overflow-hidden h-full">
                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] mb-2">Call/WhatsApp</h4>
                    <p class="text-lg font-black text-gray-900 dark:text-white tracking-tight">+91 9000621876</p>
                </div>
                <div class="mt-auto">
                    <a href="tel:+919000621876" class="inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-colors shadow-lg active:scale-95">
                        Call Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>

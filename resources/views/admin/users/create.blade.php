<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="w-10 h-10 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl flex items-center justify-center text-gray-500 hover:text-indigo-600 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="font-black text-2xl text-gray-900 dark:text-white leading-tight tracking-tighter uppercase italic">
                    {{ __('Create User') }}
                </h2>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Add a new administrator</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden shadow-sm">
                <div class="p-8">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        
                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Full Name</label>
                                <input type="text" name="name" id="name" 
                                    class="w-full bg-gray-50/50 dark:bg-gray-900/40 border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:text-white transition-all" 
                                    value="{{ old('name') }}" required placeholder="John Doe">
                                @error('name')
                                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider mt-2 px-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Email Address</label>
                                <input type="email" name="email" id="email" 
                                    class="w-full bg-gray-50/50 dark:bg-gray-900/40 border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:text-white transition-all" 
                                    value="{{ old('email') }}" required placeholder="john@example.com">
                                @error('email')
                                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider mt-2 px-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Password</label>
                                    <div x-data="{ show: false }" class="relative">
                                        <input :type="show ? 'text' : 'password'" name="password" id="password" 
                                            class="w-full bg-gray-50/50 dark:bg-gray-900/40 border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3 pr-12 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:text-white transition-all" 
                                            required>
                                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                            <!-- Eye Open -->
                                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <!-- Eye Closed -->
                                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider mt-2 px-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 px-1">Confirm Password</label>
                                    <div x-data="{ show: false }" class="relative">
                                        <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" 
                                            class="w-full bg-gray-50/50 dark:bg-gray-900/40 border-gray-100 dark:border-gray-700 rounded-2xl px-4 py-3 pr-12 text-sm focus:border-indigo-500 focus:ring-indigo-500 dark:text-white transition-all" 
                                            required>
                                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                            <!-- Eye Open -->
                                            <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <!-- Eye Closed -->
                                            <svg x-show="show" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Admin Role Toggle -->
                            <div class="pt-6 border-t border-gray-50 dark:border-gray-700">
                                <label class="inline-flex items-center cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="is_admin" value="1" class="sr-only peer" {{ old('is_admin') ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                                    </div>
                                    <span class="ms-3 text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.2em] group-hover:text-indigo-700 dark:group-hover:text-indigo-300 transition-colors">Grant Admin Access</span>
                                </label>
                                <p class="text-[9px] text-gray-400 mt-2 px-1">Check this to allow this user to access the Admin Dashboard and manage tutorials.</p>
                            </div>
                        </div>

                        <div class="mt-10 pt-6 border-t border-gray-50 dark:border-gray-700 flex items-center justify-end gap-4">
                            <a href="{{ route('admin.users.index') }}" class="text-xs font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">Cancel</a>
                            <button type="submit" class="inline-flex items-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-black uppercase italic tracking-widest rounded-xl transition-all duration-300 shadow-sm hover:shadow-indigo-200">
                                Create Admin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

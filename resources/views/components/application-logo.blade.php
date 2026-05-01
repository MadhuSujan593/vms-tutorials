<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <div class="relative group">
        <img src="{{ asset('img/vms_logo.jpeg') }}" alt="VMS Logo" class="w-10 h-10 rounded-xl shadow-md transform transition-transform group-hover:scale-105 duration-300">
    </div>
    <div class="flex items-center font-black text-lg sm:text-xl tracking-tighter uppercase italic">
        <span class="text-indigo-600 dark:text-indigo-400">VMS</span>
        <span class="text-gray-900 dark:text-white ml-1.5">Tutorials</span>
    </div>
</div>

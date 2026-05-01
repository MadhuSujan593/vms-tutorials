<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <div class="relative group">
        <img src="{{ asset('img/vms_logo.jpeg') }}" alt="VMS Logo" class="w-10 h-10 rounded-xl shadow-md transform transition-transform group-hover:scale-105 duration-300">
    </div>
    <div class="flex flex-col leading-tight">
        <span class="bg-indigo-600 text-white px-2 py-1 rounded-lg font-black text-xl tracking-tighter uppercase italic">VMS</span>
        <span class="text-indigo-600 dark:text-indigo-400 font-bold text-sm uppercase tracking-[0.2em] mt-1">Tutorials</span>
    </div>
</div>

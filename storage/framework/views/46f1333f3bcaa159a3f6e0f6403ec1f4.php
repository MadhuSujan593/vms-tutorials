<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-gray-900 dark:text-white leading-tight tracking-tighter uppercase italic">
                    <?php echo e(__('Dashboard')); ?>

                </h2>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Management Overview</p>
            </div>
            <div class="flex items-center gap-3 bg-white dark:bg-gray-800 p-2 px-3 rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold shadow-sm text-xs">
                    <?php echo e(substr(Auth::user()->name, 0, 1)); ?>

                </div>
                <div class="flex flex-col leading-none text-left">
                    <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">Admin</span>
                    <span class="text-xs font-black text-gray-900 dark:text-white leading-none tracking-tight uppercase italic"><?php echo e(Auth::user()->name); ?></span>
                </div>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Analytics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Categories Stat Card -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 group hover:border-indigo-500 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Categories</p>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter"><?php echo e($stats['categories']); ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Tutorials Stat Card -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 group hover:border-emerald-500 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Tutorials</p>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter"><?php echo e($stats['tutorials']); ?></h3>
                        </div>
                    </div>
                </div>

                <!-- Banners Stat Card -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 group hover:border-amber-500 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Active Banners</p>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter"><?php echo e($stats['active_banners']); ?><span class="text-sm font-bold text-gray-400 ml-1">/<?php echo e($stats['banners']); ?></span></h3>
                        </div>
                    </div>
                </div>

                <!-- Users Stat Card -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 group hover:border-indigo-500 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Administrators</p>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter"><?php echo e($stats['users']); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Management Section -->
            <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-50 dark:border-gray-700 bg-gray-50/40 dark:bg-gray-900/40 flex items-center gap-4">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white italic font-black text-sm">V</div>
                    <div class="text-left">
                        <h3 class="font-black text-lg text-gray-900 dark:text-white tracking-tight uppercase italic leading-none">Quick Actions</h3>
                        <p class="text-[8px] text-gray-400 font-bold uppercase tracking-widest mt-1">Management Tools</p>
                    </div>
                </div>
                <div class="p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- New Category -->
                    <a href="<?php echo e(route('admin.categories.create')); ?>" class="group p-6 bg-white dark:bg-gray-900/20 rounded-2xl border border-gray-50 dark:border-gray-800 hover:border-indigo-500 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 flex flex-col items-center text-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-900 dark:text-white uppercase italic tracking-tight">New Category</span>
                    </a>

                    <!-- New Banner -->
                    <a href="<?php echo e(route('admin.banners.create')); ?>" class="group p-6 bg-white dark:bg-gray-900/20 rounded-2xl border border-gray-50 dark:border-gray-800 hover:border-amber-500 hover:bg-white dark:hover:bg-gray-800 transition-all duration-500 flex flex-col items-center text-center gap-4">
                        <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/30 rounded-xl flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-900 dark:text-white uppercase italic tracking-tight">New Banner</span>
                    </a>

                    <!-- Manage Content -->
                    <a href="<?php echo e(route('admin.categories.index')); ?>" class="group p-6 bg-white dark:bg-gray-900/20 rounded-2xl border border-gray-100 dark:border-gray-800 hover:border-emerald-500 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 flex flex-col items-center text-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-900 dark:text-white uppercase italic tracking-tight">Full Library</span>
                    </a>

                    <!-- View Site -->
                    <a href="<?php echo e(route('home')); ?>" target="_blank" class="group p-6 bg-white dark:bg-gray-900/20 rounded-2xl border border-gray-50 dark:border-gray-800 hover:border-gray-500 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 flex flex-col items-center text-center gap-4">
                        <div class="w-12 h-12 bg-gray-50 dark:bg-gray-800 rounded-xl flex items-center justify-center text-gray-900 dark:text-gray-300 group-hover:bg-gray-900 group-hover:text-white transition-all duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-900 dark:text-white uppercase italic tracking-tight">Public Site</span>
                    </a>

                    <!-- New User -->
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="group p-6 bg-white dark:bg-gray-900/20 rounded-2xl border border-gray-50 dark:border-gray-800 hover:border-indigo-500 hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 flex flex-col items-center text-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        </div>
                        <span class="text-xs font-black text-gray-900 dark:text-white uppercase italic tracking-tight">New User</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/dashboard.blade.php ENDPATH**/ ?>
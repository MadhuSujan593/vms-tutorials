<?php if (isset($component)) { $__componentOriginal42b37f006f8ebbe12b66cfa27a5def06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42b37f006f8ebbe12b66cfa27a5def06 = $attributes; } ?>
<?php $component = App\View\Components\PublicLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('public-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\PublicLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startPush('meta'); ?>
        <meta name="description" content="Master modern technology with step-by-step professional coding tutorials for PHP, Java, JavaScript, and more. Master backend and frontend brilliance.">
        <meta property="og:title" content="VMS Tutorials - Master Modern Technology">
        <meta property="og:description" content="Step-by-step professional coding tutorials for PHP, Java, JavaScript, and more.">
        <meta name="twitter:card" content="summary_large_image">
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('mobile_sidebar'); ?>
        <div class="mb-6">
            <h3 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3 px-2">
                All Categories
            </h3>
            <nav class="space-y-1">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('public.category', $category)); ?>" 
                       @click="mobileMenuOpen = false"
                       class="group flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <?php echo e($category->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        </div>
    <?php $__env->stopPush(); ?>
    <div class="relative py-12 sm:py-16 overflow-hidden bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
        <!-- Abstract Background Gradients -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
 
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl lg:text-5xl mb-4">
                Master Modern <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-500">Technology</span>
            </h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                Step-by-step professional tutorials to elevate your coding skills. From backend logic to frontend brilliance.
            </p>
        </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <?php echo $__env->make('public.partials.banner', ['banners' => $banners], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 sm:py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('public.category', $category)); ?>" class="group relative bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                    <!-- Hover Accent -->
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-indigo-500 rounded-full opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    
                    <div>
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white mb-4 group-hover:scale-105 transition-transform duration-300 shadow-md shadow-indigo-600/30 overflow-hidden">
                            <?php if($category->icon): ?>
                            <img src="<?php echo e(asset('storage/' . $category->icon)); ?>" alt="<?php echo e($category->name); ?> icon" class="w-full h-full object-cover">
                        <?php else: ?>
                            <!-- Icon Placeholder - Letter of Category -->
                            <span class="text-xl font-bold uppercase" aria-hidden="true"><?php echo e(substr($category->name, 0, 1)); ?></span>
                            <span class="sr-only"><?php echo e($category->name); ?> category placeholder</span>
                        <?php endif; ?>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                            <?php echo e($category->name); ?>

                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4">
                            <?php echo e($category->description ?? 'Explore comprehensive tutorials and guides for '.$category->name.'.'); ?>

                        </p>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                            <?php echo e($category->tutorials_count); ?> Topics
                        </span>
                        <div class="text-indigo-600 dark:text-indigo-400 group-hover:translate-x-2 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500 text-lg">No categories available yet. Please check back later.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42b37f006f8ebbe12b66cfa27a5def06)): ?>
<?php $attributes = $__attributesOriginal42b37f006f8ebbe12b66cfa27a5def06; ?>
<?php unset($__attributesOriginal42b37f006f8ebbe12b66cfa27a5def06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42b37f006f8ebbe12b66cfa27a5def06)): ?>
<?php $component = $__componentOriginal42b37f006f8ebbe12b66cfa27a5def06; ?>
<?php unset($__componentOriginal42b37f006f8ebbe12b66cfa27a5def06); ?>
<?php endif; ?>
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/public/home.blade.php ENDPATH**/ ?>
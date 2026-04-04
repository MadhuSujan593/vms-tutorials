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
     <?php $__env->slot('title', null, []); ?> Support VMS Tutorials | Donate <?php $__env->endSlot(); ?>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-12 sm:pt-20 pb-24 text-center">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-12 text-xs font-medium justify-center text-center items-center" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?php echo e(route('home')); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                <li class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                    <span class="text-gray-400">Donate</span>
                </li>
            </ol>
        </nav>

        <header class="mb-16 max-w-2xl mx-auto">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                Support Our <span class="text-indigo-600">Mission</span>
            </h1>
            <div class="h-1 w-16 bg-indigo-600 rounded-full mb-8 mx-auto"></div>
            <p class="text-lg text-gray-600 dark:text-gray-400 leading-relaxed font-medium">
                VMS Tutorials is dedicated to providing high-quality, free technology education. Your support helps us cover hosting costs, create new content, and keep the platform ad-free.
            </p>
        </header>

        <div class="max-w-md mx-auto">
            <!-- Donation Card -->
            <div class="bg-white dark:bg-gray-800 p-8 sm:p-10 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col items-center text-center gap-6 relative overflow-hidden">
                
                <div class="w-16 h-16 bg-indigo-50 dark:bg-indigo-900/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                
                <div class="space-y-4">
                    <h4 class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-[0.2em]">Direct Contribution</h4>
                    <p class="text-xl sm:text-2xl font-black text-gray-900 dark:text-white tracking-tight">Support with UPI</p>
                    <div class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-dashed border-gray-200 dark:border-gray-700">
                        <p class="text-base font-bold text-gray-700 dark:text-gray-300 select-all tracking-tight">vms-tutorials@upi</p>
                    </div>
                </div>
                
                <div class="text-[10px] font-medium text-gray-400 dark:text-gray-500 italic italic">
                    Every contribution helps us maintain the platform. 
                </div>

                <div class="pt-4 border-t border-gray-50 dark:border-gray-700/50 w-full">
                    <p class="text-[10px] text-gray-400 dark:text-gray-500 uppercase font-bold tracking-widest">Thank you for your support.</p>
                </div>
            </div>
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
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/public/donate.blade.php ENDPATH**/ ?>
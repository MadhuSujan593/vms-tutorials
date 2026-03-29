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
     <?php $__env->slot('title', null, []); ?> <?php echo e($tutorial->title); ?> - <?php echo e($category->name); ?> | VMS Tutorials <?php $__env->endSlot(); ?>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Sidebar (Topic List) - W3Schools Style -->
            <aside class="w-full lg:w-64 flex-shrink-0 lg:sticky lg:top-24 lg:h-[calc(100vh-6rem)] overflow-y-auto pb-10 border-r border-gray-100 dark:border-gray-800 pr-4 custom-scrollbar">
                <div class="mb-8">
                    <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">
                        <?php echo e($category->name); ?> Tutorials
                    </h3>
                    <nav class="space-y-1">
                        <?php $__currentLoopData = $allTutorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('public.tutorial', [$category->slug, $item->slug])); ?>" 
                               class="group flex items-center px-3 py-2 text-sm font-medium rounded-xl transition-all duration-200 
                               <?php echo e($tutorial->id === $item->id 
                                  ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' 
                                  : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?>">
                                <span class="truncate"><?php echo e($item->title); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 min-w-0 py-8 lg:py-12">
                <!-- Breadcrumbs -->
                <nav class="flex mb-8 text-sm font-medium" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                            <a href="<?php echo e(route('public.category', $category)); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"><?php echo e($category->name); ?></a>
                        </li>
                    </ol>
                </nav>

                <article>
                    <header class="mb-12">
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-4">
                            <?php echo e($tutorial->title); ?>

                        </h1>
                        <div class="h-1.5 w-20 bg-indigo-600 rounded-full"></div>
                    </header>

                    <div class="relative">
                        <?php if (isset($component)) { $__componentOriginal6c0d1d41cb3705abfd7864e5e6250020 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c0d1d41cb3705abfd7864e5e6250020 = $attributes; } ?>
<?php $component = App\View\Components\Markdown::resolve(['content' => $tutorial->content] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('markdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Markdown::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c0d1d41cb3705abfd7864e5e6250020)): ?>
<?php $attributes = $__attributesOriginal6c0d1d41cb3705abfd7864e5e6250020; ?>
<?php unset($__attributesOriginal6c0d1d41cb3705abfd7864e5e6250020); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c0d1d41cb3705abfd7864e5e6250020)): ?>
<?php $component = $__componentOriginal6c0d1d41cb3705abfd7864e5e6250020; ?>
<?php unset($__componentOriginal6c0d1d41cb3705abfd7864e5e6250020); ?>
<?php endif; ?>
                    </div>
                </article>

                <!-- Navigation between topics -->
                <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800 flex justify-between items-center gap-4">
                    <?php
                        $prev = $allTutorials->where('created_at', '<', $tutorial->created_at)->last();
                        $next = $allTutorials->where('created_at', '>', $tutorial->created_at)->first();
                    ?>

                    <?php if($prev): ?>
                        <a href="<?php echo e(route('public.tutorial', [$category->slug, $prev->slug])); ?>" class="group flex-1 p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all shadow-sm flex flex-col items-start gap-1">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Previous Topic</span>
                            <span class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                <?php echo e($prev->title); ?>

                            </span>
                        </a>
                    <?php else: ?>
                        <div class="flex-1"></div>
                    <?php endif; ?>

                    <?php if($next): ?>
                        <a href="<?php echo e(route('public.tutorial', [$category->slug, $next->slug])); ?>" class="group flex-1 p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all shadow-sm flex flex-col items-end gap-1 text-right">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Next Topic</span>
                            <span class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <?php echo e($next->title); ?>

                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </a>
                    <?php else: ?>
                        <div class="flex-1"></div>
                    <?php endif; ?>
                </div>
            </main>

            <!-- Right Sidebar (TOC) -->
            <aside class="hidden xl:block w-64 flex-shrink-0 sticky top-24 h-[calc(100vh-6rem)] overflow-y-auto mt-12 py-12 pl-8 border-l border-gray-50 dark:border-gray-800">
                <nav class="space-y-4">
                    <h5 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-6">On this page</h5>
                    <ul class="space-y-4 text-sm font-medium">
                        <li>
                            <a href="#" class="block text-indigo-600 dark:text-indigo-400">Overview</a>
                        </li>
                        <!-- This part is dynamic via the component's TOC -->
                        <?php $md = new \App\View\Components\Markdown($tutorial->content); ?>
                        <?php $__currentLoopData = $md->toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="#<?php echo e($item['slug']); ?>" 
                                   class="block <?php echo e($item['tag'] === 'h3' ? 'pl-4' : ''); ?> text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                    <?php echo e($item['text']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </nav>
            </aside>

        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #1e293b;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
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
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/public/tutorial.blade.php ENDPATH**/ ?>
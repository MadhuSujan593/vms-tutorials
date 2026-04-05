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

    <?php $__env->startPush('meta'); ?>
        <meta name="description" content="<?php echo e($metaDescription); ?>">
        <meta property="og:title" content="<?php echo e($title); ?>">
        <meta property="og:description" content="<?php echo e($metaDescription); ?>">
        <meta name="twitter:card" content="summary_large_image">
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('mobile_sidebar'); ?>
        <?php echo $__env->make('public.partials.tutorial_nav', ['navItems' => $allTutorials], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopPush(); ?>

    <!-- Page Specific Structured Data -->
    <?php $__env->startPush('schema'); ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "<?php echo e(url('/')); ?>"
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "<?php echo e($category->name); ?>",
            "item": "<?php echo e(route('public.category', $category)); ?>"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "<?php echo e($tutorial->title); ?>",
            "item": "<?php echo e(url()->current()); ?>"
        }]
    }
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TechArticle",
        "headline": "<?php echo e($tutorial->title); ?>",
        "description": "<?php echo e($metaDescription); ?>",
        "author": {
            "@type": "Organization",
            "name": "VMS Tutorials"
        },
        "publisher": {
            "@type": "Organization",
            "name": "VMS Tutorials",
            "logo": {
                "@type": "ImageObject",
                "url": "<?php echo e(asset('img/logo.png')); ?>"
            }
        },
        "datePublished": "<?php echo e($tutorial->created_at->toIso8601String()); ?>",
        "dateModified": "<?php echo e($tutorial->updated_at->toIso8601String()); ?>",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "<?php echo e(url()->current()); ?>"
        }
    }
    </script>
    <?php $__env->stopPush(); ?>

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Left Sidebar (Desktop Only) -->
            <aside class="hidden lg:block w-64 flex-shrink-0 sticky top-32 h-[calc(100vh-8rem)] overflow-y-auto pb-10 border-r border-gray-100 dark:border-gray-800 pr-4 custom-scrollbar">
                <?php echo $__env->make('public.partials.tutorial_nav', ['navItems' => $allTutorials], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 min-w-0 py-6 lg:py-10">
                <!-- Breadcrumbs -->
                <nav class="flex mb-6 text-xs font-medium" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                            <a href="<?php echo e(route('public.category', $category)); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"><?php echo e($category->name); ?></a>
                        </li>
                    </ol>
                </nav>

                <article>
                    <header class="mb-8">
                        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-3">
                            <?php echo e($tutorial->title); ?>

                        </h1>
                        <div class="h-1 w-16 bg-indigo-600 rounded-full"></div>
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
                <div class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800 flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4">
                    <?php
                        $currentIndex = $flattenedTutorials->search(fn($t) => $t->id === $tutorial->id);
                        $prev = $currentIndex > 0 ? $flattenedTutorials->get($currentIndex - 1) : null;
                        $next = $currentIndex < $flattenedTutorials->count() - 1 ? $flattenedTutorials->get($currentIndex + 1) : null;
                    ?>

                    <?php if($prev): ?>
                        <a href="<?php echo e(route('public.tutorial', [$category->slug, $prev->slug])); ?>" class="group flex-1 p-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all shadow-sm flex flex-col items-start gap-1">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Previous Topic</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                <?php echo e($prev->title); ?>

                            </span>
                        </a>
                    <?php else: ?>
                        <div class="flex-1"></div>
                    <?php endif; ?>

                    <?php if($next): ?>
                        <a href="<?php echo e(route('public.tutorial', [$category->slug, $next->slug])); ?>" class="group flex-1 p-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all shadow-sm flex flex-col items-end gap-1 text-right">
                            <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Next Topic</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors flex items-center gap-2">
                                <?php echo e($next->title); ?>

                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                        </a>
                    <?php else: ?>
                        <div class="flex-1"></div>
                    <?php endif; ?>
                </div>
            </main>

            <!-- Right Sidebar (TOC) -->
            <aside class="hidden xl:block w-48 flex-shrink-0 sticky top-32 h-[calc(100vh-8rem)] overflow-y-auto mt-10 py-10 pl-6 border-l border-gray-50 dark:border-gray-800">
                <nav class="space-y-4">
                    <h5 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-4">On this page</h5>
                    <ul class="space-y-2 text-xs font-medium">
                        <li>
                            <a href="#" class="block text-indigo-600 dark:text-indigo-400">Overview</a>
                        </li>
                        <!-- This part is dynamic via the component's TOC -->
                        <?php $md = new \App\View\Components\Markdown($tutorial->content); ?>
                        <?php $__currentLoopData = $md->toc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="#<?php echo e($item['slug']); ?>" 
                                   class="block <?php echo e($item['tag'] === 'h3' ? 'pl-3' : ''); ?> text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                    <?php echo e($item['text']); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </nav>

                <div class="mt-12">
                    <?php echo $__env->make('public.partials.banner', ['banners' => $banners], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
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
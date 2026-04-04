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
     <?php $__env->slot('title', null, []); ?> About Us | VMS Tutorials <?php $__env->endSlot(); ?>

    <!-- Hero Section -->
    <div class="relative py-24 overflow-hidden bg-white dark:bg-gray-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            <nav class="flex mb-12 text-xs font-medium" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="<?php echo e(route('home')); ?>" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">Home</a></li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-300 dark:text-gray-700" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" /></svg>
                        <span class="text-gray-400">About Us</span>
                    </li>
                </ol>
            </nav>

            <div class="max-w-4xl">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-8 leading-[1.1]">
                    Empowering the <span class="text-indigo-600">Next Generation</span> of Developers.
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 leading-relaxed mb-10 max-w-3xl">
                    VMS Tutorials is more than just a documentation site. It's a professional ecosystem designed to turn complex instructions into clear, actionable knowledge.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo e(route('public.courses')); ?>" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition-all shadow-lg hover:shadow-indigo-500/25">Explore Courses</a>
                    <a href="<?php echo e(route('public.contact')); ?>" class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-bold rounded-2xl border border-gray-100 dark:border-gray-700 hover:border-indigo-500 transition-all">Get in Touch</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Philosophy -->
    <div class="py-24 bg-gray-50 dark:bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-black text-indigo-600 uppercase tracking-[0.3em] mb-4 text-center items-center flex justify-center">Our Philosophy</h2>
                <div class="h-1 w-12 bg-indigo-600 rounded-full mx-auto mb-6"></div>
                <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">Built by Developers, for Developers.</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-10 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-8 font-black text-2xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">01</div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Precision First</h4>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">We don't just write guides; we engineer them. Every line of code is tested, and every explanation is refined for absolute clarity.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-10 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/40 rounded-2xl flex items-center justify-center text-purple-600 dark:text-purple-400 mb-8 font-black text-2xl group-hover:bg-purple-600 group-hover:text-white transition-colors">02</div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Modern Stack</h4>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">Industry moves fast. We focus on modern frameworks and standards like Java 21, PHP 8.3, and the latest Javascript ECMAScript patterns.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-10 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-500 group">
                    <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-8 font-black text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">03</div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Community Driven</h4>
                    <p class="text-gray-500 dark:text-gray-400 leading-relaxed text-sm">Learning is a social experience. We foster a community where feedback leads directly to content improvement.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats & Trust -->
    <div class="py-24 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-indigo-600 rounded-[2.5rem] p-12 lg:p-20 text-white text-center sm:text-left shadow-2xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold mb-6 leading-tight">Mastering Technology, One Topic at a Time.</h3>
                        <p class="text-indigo-100 text-lg mb-0 font-medium">Join over 10,000 developers who trust VMS Tutorials for their daily learning and problem-solving needs.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <div class="text-5xl font-black mb-2 tracking-tighter">10k+</div>
                            <div class="text-xs font-bold uppercase tracking-widest opacity-70">Active Students</div>
                        </div>
                        <div>
                            <div class="text-5xl font-black mb-2 tracking-tighter">500+</div>
                            <div class="text-xs font-bold uppercase tracking-widest opacity-70">Guides Published</div>
                        </div>
                        <div>
                            <div class="text-5xl font-black mb-2 tracking-tighter">99%</div>
                            <div class="text-xs font-bold uppercase tracking-widest opacity-70">Success Rate</div>
                        </div>
                        <div>
                            <div class="text-5xl font-black mb-2 tracking-tighter">24/7</div>
                            <div class="text-xs font-bold uppercase tracking-widest opacity-70">Expert Support</div>
                        </div>
                    </div>
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
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/public/about.blade.php ENDPATH**/ ?>
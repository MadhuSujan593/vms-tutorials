<?php if(isset($banners) && $banners->count() > 0): ?>
    <div x-data="{ 
            activeBanner: 0, 
            bannersCount: <?php echo e($banners->count()); ?>,
            autoScroll() {
                if (this.bannersCount > 1) {
                    setInterval(() => {
                        this.activeBanner = (this.activeBanner + 1) % this.bannersCount;
                    }, 5000);
                }
            }
        }" 
        x-init="autoScroll()"
        class="my-8 group/slider overflow-hidden"
    >
        <div class="relative overflow-hidden rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md transition-all duration-300 min-h-[100px] w-full <?php echo e($aspect ?? 'aspect-[21/9] sm:aspect-[4/1] md:aspect-[5/1] lg:aspect-[6/1]'); ?>">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a x-show="activeBanner === <?php echo e($index); ?>"
                   x-transition:enter="transition ease-out duration-1000"
                   x-transition:enter-start="opacity-0 transform scale-105"
                   x-transition:enter-end="opacity-100 transform scale-100"
                   x-transition:leave="transition ease-in duration-1000"
                   x-transition:leave-start="opacity-100"
                   x-transition:leave-end="opacity-0"
                   href="<?php echo e($banner->redirect_url); ?>" 
                   target="_blank" 
                   rel="noopener sponsored" 
                   class="absolute inset-0 group block"
                   <?php if($index > 0): ?> style="display: none;" <?php endif; ?>
                >
                    <img src="<?php echo e(asset('storage/' . $banner->image_path)); ?>" 
                         alt="<?php echo e($banner->title ?? 'Advertisement'); ?>" 
                         class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                    
                    <?php if($banner->title): ?>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white text-sm font-bold"><?php echo e($banner->title); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="absolute top-2 right-2 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 border border-gray-100 dark:border-gray-800 shadow-sm transition-opacity duration-300">
                        Ad
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Indicator Dots -->
            <?php if($banners->count() > 1): ?>
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button @click="activeBanner = <?php echo e($index); ?>" 
                                class="h-1.5 transition-all duration-300 rounded-full"
                                :class="activeBanner === <?php echo e($index); ?> ? 'w-4 bg-white shadow-sm' : 'w-1.5 bg-white/40 hover:bg-white/60'">
                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/public/partials/banner.blade.php ENDPATH**/ ?>
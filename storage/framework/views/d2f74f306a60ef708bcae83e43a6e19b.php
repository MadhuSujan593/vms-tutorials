<div class="mb-6">
    <h3 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">
        <?php echo e($category->name); ?> Tutorials
    </h3>
    <nav class="space-y-1" x-data="{ openSection: <?php echo json_encode(isset($tutorial) ? ($tutorial->parent_id ?? $tutorial->id) : 0, 15, 512) ?> }">
        <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="relative">
                <?php 
                    $hasChildren = $item->children->count() > 0;
                    $currentId = $tutorial->id ?? 0;
                    $currentParentId = $tutorial->parent_id ?? 0;
                    $isDirectlyActive = ($currentId === $item->id);
                    $isActiveParent = ($currentParentId === $item->id);
                ?>

                <div class="flex items-center group gap-1">
                    <a href="<?php echo e(route('public.tutorial', [$category->slug, $item->slug])); ?>" 
                       @click="openSection = <?php echo e($item->id); ?>; mobileMenuOpen = false"
                       class="flex-1 flex items-center justify-between px-2.5 py-1.5 text-[13px] font-bold rounded-lg transition-all duration-200 
                       <?php echo e($isDirectlyActive
                          ? 'bg-indigo-600 text-white shadow-md' 
                          : ($isActiveParent 
                             ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400'
                             : 'text-gray-800 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white')); ?>">
                        <span class="truncate"><?php echo e($item->title); ?></span>
                    </a>
                    
                    <?php if($hasChildren): ?>
                        <button @click.prevent.stop="openSection = (openSection === <?php echo e($item->id); ?> ? null : <?php echo e($item->id); ?>)" 
                                class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-4 h-4 transition-transform duration-200" 
                                 :class="openSection === <?php echo e($item->id); ?> ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    <?php endif; ?>
                </div>

                <?php if($hasChildren): ?>
                    <div x-show="openSection === <?php echo e($item->id); ?>" 
                         x-collapse
                         x-cloak
                         class="mt-1 space-y-1 pl-4 border-l-2 border-gray-100 dark:border-gray-800 ml-3 transition-all duration-300">
                        <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('public.tutorial', [$category->slug, $child->slug])); ?>" 
                               @click="mobileMenuOpen = false"
                               class="group flex items-center px-2.5 py-1.5 text-[13px] font-medium rounded-lg transition-all duration-300 
                               <?php echo e((isset($tutorial) && $tutorial->id === $child->id) 
                                  ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/10' 
                                  : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?>">
                                <span class="truncate"><?php echo e($child->title); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
</div>
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/public/partials/tutorial_nav.blade.php ENDPATH**/ ?>
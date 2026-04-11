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
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">
                    &larr; Back
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <?php echo e(__('Edit Category')); ?>: <?php echo e($category->name); ?>

                </h2>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <form method="POST" action="<?php echo e(route('admin.categories.update', $category)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-sm" value="<?php echo e(old('name', $category->name)); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Icon -->
                        <div class="mb-4">
                            <label for="icon" class="block text-sm font-medium text-gray-700">Category Icon (Logo)</label>
                            <?php if($category->icon): ?>
                                <div class="mt-2 mb-4 flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-md overflow-hidden">
                                        <img src="<?php echo e(asset('storage/' . $category->icon)); ?>" alt="<?php echo e($category->name); ?>" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-xs text-gray-500 font-medium italic">Current Icon</span>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="icon" id="icon" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-xs text-gray-400 mt-1 italic">Leave empty to keep the current icon.</p>
                            <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Slug (Read Only Display) -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-500">Current Slug (Autogenerated)</label>
                            <input type="text" disabled class="mt-1 block w-full rounded-md border-gray-200 bg-gray-50 text-gray-500 shadow-sm sm:text-sm cursor-not-allowed" value="<?php echo e($category->slug); ?>">
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
                            <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-sm"><?php echo e(old('description', $category->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Blog Post Category Toggle -->
                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="is_blog" id="is_blog" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" <?php echo e(old('is_blog', $category->is_blog) ? 'checked' : ''); ?>>
                            <label for="is_blog" class="ml-2 block text-sm font-medium text-gray-900">
                                This is a Blog Category
                                <p class="text-xs text-gray-500 font-normal">If checked, it will bypass structured sidebars and show on the top Navbar instead.</p>
                            </label>
                        </div>

                        <!-- Related Categories -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Related Categories (Many-to-Many Vise-Versa)</label>
                            <?php
                                $currentRelated = $category->relatedCategories->pluck('id')->toArray();
                            ?>
                            <div class="space-y-2 border border-gray-300 rounded-md p-4 max-h-48 overflow-y-auto bg-gray-50">
                                <?php $__empty_1 = true; $__currentLoopData = $categoriesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input type="checkbox" name="related_categories[]" id="related_<?php echo e($cat->id); ?>" value="<?php echo e($cat->id); ?>" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" <?php echo e((collect(old('related_categories', $currentRelated))->contains($cat->id)) ? 'checked' : ''); ?>>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="related_<?php echo e($cat->id); ?>" class="font-medium text-gray-700"><?php echo e($cat->name); ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-sm text-gray-500">No other categories available.</p>
                                <?php endif; ?>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Linking here will also link the other category back to this one automatically.</p>
                            <?php $__errorArgs = ['related_categories'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="flex items-center justify-end border-t pt-4">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none">
                                Update Category
                            </button>
                        </div>
                    </form>
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
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>
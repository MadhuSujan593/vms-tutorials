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
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <a href="<?php echo e(route('admin.categories.index')); ?>" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <?php echo e(__('Tutorials in ')); ?> <?php echo e($category->name); ?>

                </h2>
            </div>
            <a href="<?php echo e(route('admin.categories.tutorials.create', $category)); ?>" class="iniline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none    transition ease-in-out duration-150">
                Create Tutorial
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <?php if(session('success')): ?>
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-init="setTimeout(() => show = false, 5000)"
                     class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-xl relative shadow-sm transition-all duration-500" 
                     role="alert">
                    <span class="block sm:inline font-medium"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-none border border-gray-200 sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">
                                        
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Title
                                    </th>

                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Created At
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider text-right">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $tutorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutorial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr data-id="<?php echo e($tutorial->id); ?>" class="sortable-row">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="cursor-move text-gray-400 hover:text-gray-600 drag-handle">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap font-medium">
                                            <?php echo e($tutorial->title); ?>

                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <?php if($tutorial->is_published): ?>
                                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Published</span>
                                            </span>
                                        <?php else: ?>
                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Draft</span>
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-500 whitespace-no-wrap">
                                            <?php echo e($tutorial->created_at->format('M d, Y')); ?>

                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                        <a href="<?php echo e(route('admin.categories.tutorials.edit', [$category, $tutorial])); ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="<?php echo e(route('admin.categories.tutorials.destroy', [$category, $tutorial])); ?>" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this tutorial?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                                        No tutorials found.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        <?php echo e($tutorials->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.querySelector('tbody');
            const sortable = new Sortable(el, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'bg-indigo-50',
                onEnd: function() {
                    const ids = Array.from(el.querySelectorAll('tr.sortable-row')).map(tr => tr.dataset.id);
                    
                    fetch('<?php echo e(route('admin.categories.tutorials.reorder', $category)); ?>', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({ ids: ids })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Optional: Show a small success toast
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
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
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/admin/tutorials/index.blade.php ENDPATH**/ ?>
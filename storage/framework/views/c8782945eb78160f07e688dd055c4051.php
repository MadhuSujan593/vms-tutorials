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
        <div class="flex items-center">
            <a href="<?php echo e(route('admin.categories.tutorials.index', $category)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-4">
                &larr; Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Create Tutorial in ')); ?> <?php echo e($category->name); ?>

            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    <link rel="stylesheet" href="<?php echo e(asset('vendor/easymde.min.css')); ?>">
    <style>
        /* Professional Preview Styling */
        .editor-preview, .editor-preview-side {
            background: #ffffff !important;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
            color: #1a202c !important;
            line-height: 1.6 !important;
        }
        .editor-preview h1, .editor-preview-side h1 { font-size: 2.25rem !important; font-weight: 800 !important; margin-bottom: 1.5rem !important; border-bottom: 1px solid #e2e8f0 !important; padding-bottom: 0.5rem !important; }
        .editor-preview h2, .editor-preview-side h2 { font-size: 1.875rem !important; font-weight: 700 !important; margin-top: 2rem !important; margin-bottom: 1rem !important; border-bottom: 1px solid #edf2f7 !important; padding-bottom: 0.3rem !important; }
        .editor-preview h3, .editor-preview-side h3 { font-size: 1.5rem !important; font-weight: 600 !important; margin-top: 1.5rem !important; margin-bottom: 0.75rem !important; }
        .editor-preview p, .editor-preview-side p { margin-bottom: 1.25rem !important; }
        .editor-preview ul, .editor-preview-side ul { list-style-type: disc !important; margin-left: 1.5rem !important; margin-bottom: 1.25rem !important; }
        .editor-preview li, .editor-preview-side li { margin-bottom: 0.5rem !important; }
        .editor-preview strong, .editor-preview-side strong { font-weight: 700 !important; color: #111827 !important; }
        
        /* MAGIC: Make the symbols faint in the main editor */
        .CodeMirror .cm-formatting-header, 
        .CodeMirror .cm-formatting-strong, 
        .CodeMirror .cm-formatting-em { 
            opacity: 0.4 !important; 
            font-weight: normal !important;
        }
        /* Make headings big in the EDITOR area */
        .CodeMirror .cm-header-1 { font-size: 2rem !important; font-weight: bold !important; color: #111 !important; }
        .CodeMirror .cm-header-2 { font-size: 1.5rem !important; font-weight: bold !important; color: #222 !important; }
        .CodeMirror .cm-header-3 { font-size: 1.25rem !important; font-weight: bold !important; color: #333 !important; }
    </style>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="<?php echo e(route('admin.categories.tutorials.store', $category)); ?>">
                        <?php echo csrf_field(); ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Tutorial Title</label>
                                <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-lg" value="<?php echo e(old('title')); ?>" placeholder="Enter an engaging title...">
                                <?php $__errorArgs = ['title'];
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

                            <!-- Parent Selection -->
                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Section (Optional)</label>
                                <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 sm:text-md">
                                    <option value="">-- Main Topic (Top Level) --</option>
                                    <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($parent->id); ?>" <?php echo e(old('parent_id') == $parent->id ? 'selected' : ''); ?>>
                                            <?php echo e($parent->title); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <p class="text-xs text-gray-400 mt-1 italic">Leave empty to make this a top-level category.</p>
                                <?php $__errorArgs = ['parent_id'];
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
                        </div>

                        <!-- Markdown Content Editor -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Tutorial Content (Markdown supported)</label>
                            <textarea name="content" id="content-editor" rows="15" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-sm"><?php echo e(old('content')); ?></textarea>
                            <?php $__errorArgs = ['content'];
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

                        <!-- Publish Toggle -->
                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-0 focus:ring-offset-0" <?php echo e(old('is_published') ? 'checked' : ''); ?>>
                            <label for="is_published" class="ml-2 block text-sm text-gray-900">Publish immediately?</label>
                        </div>

                        <div class="flex items-center justify-end border-t pt-4">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-6 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none">
                                Save Tutorial
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo e(asset('vendor/easymde.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/turndown.js')); ?>"></script>
    <script>
        (function() {
            function startEditor() {
                if (typeof EasyMDE === 'undefined') {
                    console.warn("EasyMDE not found, retrying...");
                    setTimeout(startEditor, 200);
                    return;
                }

                console.log("Initializing EasyMDE...");
                const easyMDE = new EasyMDE({
                    element: document.getElementById('content-editor'),
                    spellChecker: false,
                    forceSync: true,
                    autosave: {
                        enabled: true,
                        uniqueId: "create_tutorial",
                        delay: 1000,
                    },
                    renderingConfig: {
                        singleLineBreaks: false,
                        codeSyntaxHighlighting: true,
                    },
                    placeholder: "Paste your W3Schools content here...",
                    toolbar: [
                        "bold", "italic", "heading", "|", 
                        "quote", "unordered-list", "ordered-list", "|", 
                        "link", "image", "code", "table", "|", 
                        "preview", "side-by-side", "fullscreen", "|", 
                        {
                            name: "guide",
                            action: "https://www.markdownguide.org/basic-syntax/",
                            className: "fa fa-question-circle",
                            title: "Markdown Guide",
                        }
                    ]
                });

                const TurndownConstructor = typeof TurndownService !== 'undefined' ? TurndownService : (typeof Turndown !== 'undefined' ? Turndown : undefined);

                if (typeof TurndownConstructor !== 'undefined') {
                    const turndownService = new TurndownConstructor({
                        headingStyle: 'atx',
                        codeBlockStyle: 'fenced',
                        bullet: '-'
                    });

                    // Keep it clean: Remove style tags and script tags from pasted content
                    turndownService.remove(['style', 'script', 'head', 'meta']);

                    easyMDE.codemirror.on("paste", function(instance, event) {
                        const html = event.clipboardData.getData("text/html");
                        if (html) {
                            event.preventDefault();
                            let markdown = turndownService.turndown(html);
                            
                            // Cleanup common W3Schools artifacts
                            markdown = markdown.replace(/\n{3,}/g, '\n\n'); // Max 2 newlines
                            
                            instance.replaceSelection(markdown);
                        }
                    });
                }

                // Ensure the editor stays "Normal Size" and not Full Screen
            }

            if (document.readyState === 'complete') {
                startEditor();
            } else {
                window.addEventListener('load', startEditor);
            }
        })();
    </script>
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
<?php /**PATH C:\Users\madhu\OneDrive\Desktop\Projects\vms-tutorials\resources\views/admin/tutorials/create.blade.php ENDPATH**/ ?>
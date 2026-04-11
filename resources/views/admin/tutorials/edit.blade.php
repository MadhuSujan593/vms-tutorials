<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('admin.categories.tutorials.index', $category) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                    &larr; Back
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Edit Tutorial in ') }} {{ $category->name }}: {{ $tutorial->title }}
                </h2>
            </div>
        </div>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('vendor/easymde.min.css') }}">
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
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.categories.tutorials.update', [$category, $tutorial]) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Tutorial Title</label>
                                <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-lg" value="{{ old('title', $tutorial->title) }}">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Parent Selection -->
                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent Section (Optional)</label>
                                <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 sm:text-md">
                                    <option value="">-- Main Topic (Top Level) --</option>
                                    @foreach($parents as $parent)
                                        <option value="{{ $parent->id }}" {{ old('parent_id', $tutorial->parent_id) == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-400 mt-1 italic">Move this tutorial to a different main section if needed.</p>
                                @error('parent_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                            <!-- Slug (Display only) -->
                            <div class="md:col-span-3">
                                <label class="block text-sm font-medium text-gray-500">Current Slug (Autogenerated)</label>
                                <input type="text" disabled class="mt-1 block w-full rounded-md border-gray-200 bg-gray-50 text-gray-500 shadow-sm sm:text-sm cursor-not-allowed" value="{{ $tutorial->slug }}">
                            </div>
                        </div>

                        <!-- Markdown Content Editor -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Tutorial Content (Markdown supported)</label>
                            <textarea name="content" id="content-editor" rows="20" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-sm">{{ old('content', $tutorial->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publish Toggle -->
                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-0 focus:ring-offset-0" {{ old('is_published', $tutorial->is_published) ? 'checked' : '' }}>
                            <label for="is_published" class="ml-2 block text-sm text-gray-900">Publish immediately?</label>
                        </div>

                        <div class="flex items-center justify-end border-t pt-4">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-6 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none">
                                Update Tutorial
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('vendor/easymde.min.js') }}"></script>
    <script src="{{ asset('vendor/turndown.js') }}"></script>
    <script src="https://unpkg.com/turndown-plugin-gfm/dist/turndown-plugin-gfm.js"></script>
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
                        uniqueId: "edit_tutorial_{{ $tutorial->id }}",
                        delay: 1000,
                    },
                    renderingConfig: {
                        singleLineBreaks: false,
                        codeSyntaxHighlighting: true,
                    },
                    toolbar: [
                        "bold", "italic", "|", "heading-1", "heading-2", "heading-3", "|", 
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

                    if (typeof turndownPluginGfm !== 'undefined') {
                        turndownService.use(turndownPluginGfm.tables);
                    } else {
                        turndownService.keep(['table', 'thead', 'tbody', 'tr', 'th', 'td']);
                    }

                    easyMDE.codemirror.on("paste", function(instance, event) {
                        const html = event.clipboardData.getData("text/html");
                        if (html) {
                            event.preventDefault();
                            let markdown = turndownService.turndown(html);
                            
                            // Cleanup common W3Schools artifacts
                            markdown = markdown.replace(/\n{3,}/g, '\n\n'); 
                            
                            instance.replaceSelection(markdown);
                        }
                    });
                }

                // Keep it normal size
            }

            if (document.readyState === 'complete') {
                startEditor();
            } else {
                window.addEventListener('load', startEditor);
            }
        })();
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('admin.categories.tutorials.index', $category) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                &larr; Back
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Tutorial in ') }} {{ $category->name }}
            </h2>
        </div>
    </x-slot>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>
    <style>
        .tox-tinymce {
            border-radius: 0.375rem !important;
            border-color: #d1d5db !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.categories.tutorials.store', $category) }}">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Tutorial Title</label>
                                <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500  sm:text-lg" value="{{ old('title') }}" placeholder="Enter an engaging title...">
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
                                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                            {{ $parent->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-400 mt-1 italic">Leave empty to make this a top-level category.</p>
                                @error('parent_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- HTML Content Editor -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Tutorial Content</label>
                            <textarea name="content" id="content-editor" rows="20" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 sm:text-sm">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publish Toggle -->
                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-0 focus:ring-offset-0" {{ old('is_published') ? 'checked' : '' }}>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            tinymce.init({
                selector: '#content-editor',
                plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
                menubar: 'file edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link codesample | removeformat fullscreen preview',
                toolbar_mode: 'wrap',
                toolbar_sticky: true,
                image_advtab: true,
                promotion: false,
                branding: false,
                height: 700,
                content_style: 'body { font-family: ui-sans-serif, system-ui, -apple-system, sans-serif; font-size: 16px; line-height: 1.6; } ul, ol { padding-left: 1.5rem; } ul, ul ul, ul ul ul { list-style-type: disc !important; } ol, ol ol, ol ol ol { list-style-type: decimal !important; }',
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append('image', blobInfo.blob());

                        fetch("{{ route('admin.upload-image') }}", {
                            method: "POST",
                            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.url) { 
                                resolve(data.url); 
                            } else { 
                                reject(data.error || "Upload failed"); 
                            }
                        })
                        .catch(err => {
                            reject("Network error occurred");
                        });
                    });
                }
            });
        });
    </script>
</x-app-layout>

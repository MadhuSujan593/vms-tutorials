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

                        <!-- Quiz Questions Section -->
                        <div class="mt-12 border-t border-gray-100 pt-10" x-data="{ 
                            questions: @js(old('quizzes', [])),
                            addQuestion() {
                                this.questions.push({
                                    id: null,
                                    question: '',
                                    option_a: '',
                                    option_b: '',
                                    option_c: '',
                                    option_d: '',
                                    correct_answer: 'a',
                                    explanation: ''
                                });
                            },
                            removeQuestion(index) {
                                this.questions.splice(index, 1);
                            }
                        }">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 tracking-tight">Tutorial Quiz</h3>
                                        <p class="text-xs text-gray-500">Add interactive questions to engage your readers.</p>
                                    </div>
                                </div>
                                <button type="button" @click="addQuestion()" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all shadow-sm hover:shadow">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Add Question
                                </button>
                            </div>

                            <div class="space-y-8">
                                <template x-for="(q, index) in questions" :key="index">
                                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 relative">
                                        <button type="button" @click="removeQuestion(index)" class="absolute top-4 right-4 text-red-500 hover:text-red-700">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>

                                        <div class="grid grid-cols-1 gap-4">
                                            <!-- Question -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Question <span x-text="index + 1"></span></label>
                                                <textarea :name="`quizzes[${index}][question]`" x-model="q.question" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 sm:text-sm" required></textarea>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <!-- Option A -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Option A</label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                            <input type="radio" :name="`quizzes[${index}][correct_answer]`" value="a" x-model="q.correct_answer" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                        </span>
                                                        <input type="text" :name="`quizzes[${index}][option_a]`" x-model="q.option_a" class="focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md border-gray-300 sm:text-sm" placeholder="Option A" required>
                                                    </div>
                                                </div>

                                                <!-- Option B -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Option B</label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                            <input type="radio" :name="`quizzes[${index}][correct_answer]`" value="b" x-model="q.correct_answer" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                        </span>
                                                        <input type="text" :name="`quizzes[${index}][option_b]`" x-model="q.option_b" class="focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md border-gray-300 sm:text-sm" placeholder="Option B" required>
                                                    </div>
                                                </div>

                                                <!-- Option C -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Option C (Optional)</label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                            <input type="radio" :name="`quizzes[${index}][correct_answer]`" value="c" x-model="q.correct_answer" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                        </span>
                                                        <input type="text" :name="`quizzes[${index}][option_c]`" x-model="q.option_c" class="focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md border-gray-300 sm:text-sm" placeholder="Option C">
                                                    </div>
                                                </div>

                                                <!-- Option D -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Option D (Optional)</label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                                            <input type="radio" :name="`quizzes[${index}][correct_answer]`" value="d" x-model="q.correct_answer" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                        </span>
                                                        <input type="text" :name="`quizzes[${index}][option_d]`" x-model="q.option_d" class="focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md border-gray-300 sm:text-sm" placeholder="Option D">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Explanation -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Explanation (Shown when answer is revealed)</label>
                                                <textarea :name="`quizzes[${index}][explanation]`" x-model="q.explanation" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 sm:text-sm" placeholder="Explain why this is correct..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <div x-show="questions.length === 0" class="text-center py-10 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300">
                                    <p class="text-gray-500">No quiz questions added yet.</p>
                                    <button type="button" @click="addQuestion()" class="mt-2 text-indigo-600 hover:text-indigo-900 font-medium">Add your first question</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end border-t pt-4 mt-8">
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
                paste_data_images: true,
                paste_as_text: false,
                paste_preprocess: function(plugin, args) {
                    // Strip empty paragraphs and list items that cause phantom dots
                    args.content = args.content.replace(/<(p|li)>(\s|&nbsp;|<br\/?>)*<\/\1>/gi, '');
                },
                content_style: 'body { font-family: ui-sans-serif, system-ui, -apple-system, sans-serif; font-size: 16px; line-height: 1.6; } ul, ol { padding-left: 1.25rem; } ul, ul ul, ul ul ul { list-style-type: disc !important; } ol, ol ol, ol ol ol { list-style-type: decimal !important; }',
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

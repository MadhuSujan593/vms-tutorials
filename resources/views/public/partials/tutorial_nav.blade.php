<div class="mb-6">
    <h3 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">
        {{ $category->name }} Tutorials
    </h3>
    <nav class="space-y-1" x-data="{ openSection: @json(isset($tutorial) ? ($tutorial->parent_id ?? $tutorial->id) : 0) }">
        @foreach($navItems as $item)
            <div class="relative">
                @php 
                    $hasChildren = $item->children->count() > 0;
                    $currentId = $tutorial->id ?? 0;
                    $currentParentId = $tutorial->parent_id ?? 0;
                    $isDirectlyActive = ($currentId === $item->id);
                    $isActiveParent = ($currentParentId === $item->id);
                @endphp

                <div class="flex items-center group gap-1">
                    <a href="{{ route('public.tutorial', [$category->slug, $item->slug]) }}" 
                       @click="openSection = {{ $item->id }}; mobileMenuOpen = false"
                       class="flex-1 flex items-center justify-between px-2.5 py-1.5 text-[13px] font-bold rounded-lg transition-all duration-200 
                       {{ $isDirectlyActive
                          ? 'bg-indigo-600 text-white shadow-md' 
                          : ($isActiveParent 
                             ? 'bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400'
                             : 'text-gray-800 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white') }}">
                        <span class="truncate">{{ $item->title }}</span>
                    </a>
                    
                    @if($hasChildren)
                        <button @click.prevent.stop="openSection = (openSection === {{ $item->id }} ? null : {{ $item->id }})" 
                                class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <svg class="w-4 h-4 transition-transform duration-200" 
                                 :class="openSection === {{ $item->id }} ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    @endif
                </div>

                @if($hasChildren)
                    <div x-show="openSection === {{ $item->id }}" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="mt-1 space-y-1 pl-4 border-l-2 border-gray-100 dark:border-gray-800 ml-3">
                        @foreach($item->children as $child)
                            <a href="{{ route('public.tutorial', [$category->slug, $child->slug]) }}" 
                               @click="mobileMenuOpen = false"
                               class="group flex items-center px-2.5 py-1.5 text-[13px] font-medium rounded-lg transition-all duration-200 
                               {{ (isset($tutorial) && $tutorial->id === $child->id) 
                                  ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/10' 
                                  : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                                <span class="truncate">{{ $child->title }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </nav>
</div>

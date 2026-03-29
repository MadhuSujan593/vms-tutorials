<div class="mb-6">
    <h3 class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest mb-3">
        {{ $category->name }} Tutorials
    </h3>
    <nav class="space-y-1" x-data="{ openSection: @json(($tutorial->parent_id ?? ($tutorial->id ?? 0))) }">
        @foreach($navItems as $item)
            <div class="relative">
                @php 
                    $hasChildren = $item->children->count() > 0;
                    $isActiveParent = ($tutorial->id === $item->id || $tutorial->parent_id === $item->id);
                    $linkTarget = $hasChildren ? $item->children->first() : $item;
                @endphp

                <div class="flex items-center group">
                    <a href="{{ route('public.tutorial', [$category->slug, $linkTarget->slug]) }}" 
                       @click="openSection = {{ $item->id }}; mobileMenuOpen = false"
                       class="flex-1 group flex items-center justify-between px-2.5 py-1.5 text-[13px] font-bold rounded-lg transition-all duration-200 
                       {{ $isActiveParent
                          ? 'bg-indigo-600/10 text-indigo-600 dark:text-indigo-400' 
                          : 'text-gray-800 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        <span class="truncate">{{ $item->title }}</span>
                        
                        @if($hasChildren)
                            <svg @click.prevent.stop="openSection = (openSection === {{ $item->id }} ? null : {{ $item->id }})" 
                                 class="w-4 h-4 transition-transform duration-200" 
                                 :class="openSection === {{ $item->id }} ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        @endif
                    </a>
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
                               {{ $tutorial->id === $child->id 
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

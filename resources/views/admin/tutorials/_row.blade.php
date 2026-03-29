<tr data-id="{{ $tutorial->id }}" class="sortable-row {{ $level > 0 ? 'bg-gray-50/50' : '' }}">
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <div class="cursor-move text-gray-400 hover:text-gray-600 drag-handle">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
        </div>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            @if($level > 0)
                <span class="text-gray-300 mr-2">└─</span>
            @endif
            <p class="text-gray-900 whitespace-no-wrap {{ $level === 0 ? 'font-bold' : 'font-medium' }}">
                {{ $tutorial->title }}
            </p>
        </div>
    </td>

    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        @if($tutorial->is_published)
            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                <span class="relative text-xs">Published</span>
            </span>
        @else
            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                <span class="relative text-xs">Draft</span>
            </span>
        @endif
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm italic text-gray-400">
        {{ $level === 0 ? 'Main Topic' : 'Sub-topic' }}
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm text-right">
        <a href="{{ route('admin.categories.tutorials.edit', [$category, $tutorial]) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
        <form action="{{ route('admin.categories.tutorials.destroy', [$category, $tutorial]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this tutorial?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
        </form>
    </td>
</tr>

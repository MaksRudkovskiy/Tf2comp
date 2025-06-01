@if ($paginator->hasPages())
    <div class="flex items-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 bg-main border-tf rounded text-gray-500 cursor-not-allowed">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-main border-tf rounded hover:bg-catalog transition">&laquo;</a>
        @endif

        {{-- Current Page --}}
        <span class="px-4 py-2 bg-main border-tf rounded">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-main border-tf rounded hover:bg-catalog transition">&raquo;</a>
        @else
            <span class="px-4 py-2 bg-main border-tf rounded text-gray-500 cursor-not-allowed">&raquo;</span>
        @endif
    </div>
@endif

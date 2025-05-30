@if ($paginator->hasPages())
    <div class="flex items-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled px-2">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2">&laquo;</a>
        @endif

        {{-- Current Page --}}
        <span class="px-4">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2">&raquo;</a>
        @else
            <span class="disabled px-2">&raquo;</span>
        @endif
    </div>
@endif

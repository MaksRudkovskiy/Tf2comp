<x-app-layout>
    <x-slot name="pageTitle">Блог</x-slot>

    <div class="w-3/4 mx-auto">
        @foreach($posts as $post)
            <div class="bg-front border-tf w-11/12 my-11 py-7 px-10 mx-auto rounded">
                <h1 class="border-bottom-EBE3CB text-2xl">
                    {{ $post->title }}
                </h1>

                <p class="font-tf2 mt-5">
                    {!! nl2br(e($post->text)) !!}
                </p>
            </div>
        @endforeach
    </div>

    @if ($posts->hasPages())
        <div class="flex items-center gap-x-3 justify-center my-4">

            @if ($posts->onFirstPage())
                <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&laquo;</span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&laquo;</a>
            @endif

            <span class="px-4 py-2 bg-front border-tf rounded">{{ $posts->currentPage() }} / {{ $posts->lastPage() }}</span>

            @if ($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&raquo;</a>
            @else
                <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&raquo;</span>
            @endif
        </div>
    @endif
</x-app-layout>

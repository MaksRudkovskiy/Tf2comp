<x-app-layout>
    <x-slot name="pageTitle">Баги и фишки</x-slot>

    <div class="w-3/4 mx-auto py-12">
        <div class="flex flex-wrap justify-between gap-y-8">
            @forelse($bugs as $bug)
                <div class="p-5 bg-front border-tf w-full mw420 hover:bg-front/80 transition-colors">
                    <a href="{{ route('bugs_detail', ['id' => $bug->id]) }}" class="block">
                        <h2 class="text-xl text-center">
                            {{ $bug->title }}
                        </h2>

                        <p class="font-tf2 text-lg mt-3">
                            {{ Str::limit($bug->text, 200) }}
                            <span class="font-tf2build text-lg block mt-2">Узнать больше →</span>
                        </p>
                    </a>
                </div>
            @empty
                <div class="w-full text-center py-8">
                    <p class="font-tf2 text-lg">Баги и фишки пока не добавлены</p>
                </div>
            @endforelse
        </div>
    </div>

    @if ($bugs->hasPages())
        <div class="flex items-center gap-x-3 justify-center my-4">

            @if ($bugs->onFirstPage())
                <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&laquo;</span>
            @else
                <a href="{{ $bugs->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&laquo;</a>
            @endif

            <span class="px-4 py-2 bg-front border-tf rounded">{{ $bugs->currentPage() }} / {{ $bugs->lastPage() }}</span>

            @if ($bugs->hasMorePages())
                <a href="{{ $bugs->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&raquo;</a>
            @else
                <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&raquo;</span>
            @endif
        </div>
    @endif
</x-app-layout>

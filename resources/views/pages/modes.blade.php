<x-app-layout>
    <x-slot name="pageTitle">Игровые режимы</x-slot>

    <div class="w-3/4 mx-auto pb-12">
        @forelse($modes as $mode)
            <div class="mt-12">

                <h1 class="border-bottom-EBE3CB text-2xl">
                    <div class="flex justify-between w-full">
                        {{ $mode->title }}

                        <div class="flex items-center mb-2">
                            @if($mode->editor->avatar)
                                <img class="h-6 w-6 rounded-full mr-2" src="data:image/jpeg;base64,{{ base64_encode($mode->editor->avatar) }}" alt="">
                            @else
                                <div class="h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                    <span class="text-xs text-gray-600">{{ strtoupper(substr($mode->editor->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="text-xs text-gray-500">Последнее изменение: {{ $mode->editor->name }}, {{ $mode->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </h1>

                <p class="font-tf2 text-xl mt-5">
                    {!! nl2br(e($mode->text)) !!}
                </p>
            </div>
            @empty
            <div class="w-full text-center py-8">
                <p class="font-tf2 text-lg">Нету данных о игровых режимах</p>
            </div>
        @endforelse
    </div>

    @if ($modes->hasPages())
        <div class="flex items-center gap-x-3 justify-center my-4">

            @if ($modes->onFirstPage())
                <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&laquo;</span>
            @else
                <a href="{{ $modes->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&laquo;</a>
            @endif

            <span class="px-4 py-2 bg-front border-tf rounded">{{ $modes->currentPage() }} / {{ $modes->lastPage() }}</span>

            @if ($modes->hasMorePages())
                <a href="{{ $modes->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&raquo;</a>
            @else
                <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&raquo;</span>
            @endif
        </div>
    @endif
</x-app-layout>

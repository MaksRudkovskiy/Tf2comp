<x-app-layout>
    <x-slot name="pageTitle">Консольные команды</x-slot>

    <div class="w-3/4 mx-auto">
        <div class="bg-front border-tf w-11/12 my-11 px-10 py-7 mx-auto rounded">

            @forelse($commands as $command)
                <div class="mb-12">
                    <h1 class="border-bottom-EBE3CB text-2xl">
                        {{ $command->title }}
                    </h1>

                    <p class="font-tf2 text-xl mt-5">
                        {!! nl2br(e($command->text)) !!}
                    </p>
                </div>
            @empty
                <div class="w-full text-center py-8">
                    <p class="font-tf2 text-lg">Исторические материалы пока не добавлены</p>
                </div>
            @endforelse
        </div>

        @if ($commands->hasPages())
            <div class="flex items-center gap-x-3 justify-center my-4">

                @if ($commands->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&laquo;</span>
                @else
                    <a href="{{ $commands->previousPageUrl() }}" rel="prev" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&laquo;</a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">{{ $commands->currentPage() }} / {{ $commands->lastPage() }}</span>

                @if ($commands->hasMorePages())
                    <a href="{{ $commands->nextPageUrl() }}" rel="next" class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">&raquo;</a>
                @else
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">&raquo;</span>
                @endif
            </div>
        @endif

    </div>

</x-app-layout>

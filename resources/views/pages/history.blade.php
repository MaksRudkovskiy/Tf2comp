<x-app-layout>
    <x-slot name="pageTitle">{{ $history->title }}</x-slot>

    <div class="w-3/4 mx-auto my-8">
        <div class="bg-front border-tf w-11/12 py-7 px-10 mx-auto rounded">
            <div class="mb-12">
                <h1 class="border-bottom-EBE3CB text-2xl">
                    <div class="flex justify-between w-full">
                        {{ $history->title }}

                        <div class="flex items-center mb-2">
                            @if($history->editor->avatar)
                                <img class="h-6 w-6 rounded-full mr-2" src="data:image/jpeg;base64,{{ base64_encode($history->editor->avatar) }}" alt="">
                            @else
                                <div class="h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                    <span class="text-xs text-gray-600">{{ strtoupper(substr($history->editor->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="text-xs text-gray-500">Последнее изменение: {{ $history->editor->name }}, {{ $history->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </h1>

                <div class="font-tf2 text-xl mt-5 space-y-4">
                    {!! nl2br(e($history->text)) !!}
                </div>
            </div>

            <a href="{{ route('histories') }}"
               class="inline-block mt-6 px-4 py-2 bg-block border-tf hover:bg-front transition-colors font-tf2">
                ← Вернуться к списку историй
            </a>
        </div>
    </div>


</x-app-layout>

<x-app-layout>
    <x-slot name="pageTitle">{{ $history->title }}</x-slot>

    <div class="w-3/4 mx-auto my-8">
        <div class="bg-front border-tf w-11/12 py-7 px-10 mx-auto rounded">
            <div class="mb-12">
                <h1 class="border-bottom-EBE3CB text-2xl font-tf2">
                    {{ $history->title }}
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

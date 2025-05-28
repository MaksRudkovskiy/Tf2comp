<x-app-layout>
    <x-slot name="pageTitle">{{ $character->name }}</x-slot>

    <div class="w-3/4 mx-auto flex justify-between my-10">
        <div class="flex">
            @if($character->red_picture)
                <div class="relative w-[600px] h-[750px] flex items-center justify-center overflow-hidden">
                    <img src="{{ asset($character->red_picture) }}"
                         alt="{{ $character->name }}"
                         class="object-contain max-w-full max-h-full">
                </div>
            @else
                <div class="w-[600px] h-[750px] bg-gray-200 flex items-center justify-center">
                    <span>Изображение отсутствует</span>
                </div>
            @endif

            <div class="flex ml-4">
                <div class="flex flex-col gap-4 mr-9">
                    <x-primary-button class="text-custom-ret hover:text-custom-EBE3CB w-32 text-4xl">Крс</x-primary-button>
                    <x-primary-button class="text-custom-blu hover:text-custom-EBE3CB w-32 text-4xl">Син</x-primary-button>
                </div>

                <div class="bg-front border-tf rounded-lg p-7 mb-8">
                    <h3 class="text-2xl mb-4 w-full border-bottom-EBE3CB">ОПИСАНИЕ</h3>
                    <div class="space-y-4">
                        <p class="font-tf2">{{ $character->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

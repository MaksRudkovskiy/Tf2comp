<x-app-layout>
    <x-slot name="pageTitle">{{ $character->name }}</x-slot>

    <div class="flex relative">
        <!-- Боковая панель с классами -->
        <div class="absolute left-0 top-20 transform bg-front flex flex-col rounded-r-sm py-5 z-10 border-tf md:w-20 w-16">
            @foreach($allCharacters as $char)
                <a href="{{ route('character.show', $char->id) }}"
                   class="group flex flex-col items-center
                          @if($char->id == $character->id) opacity-100 @else opacity-50 hover:opacity-75 @endif">
                    <span class="text-4xl group-hover:text-custom-text-hover font-tf2icons">
                        {{ $char->getIconLetter() }}
                    </span>
                    <span class="text-xs mt-2 group-hover:text-custom-text-hover text-center">
                        {{ $char->name }}
                    </span>
                </a>
            @endforeach
        </div>

        <!-- Основное содержимое -->
        <div class="flex-1">
            <div class="w-3/4 mx-auto relative flex justify-between my-10">
                <div class="flex">
                    <!-- Контейнер для изображения -->
                    <div class="relative w-1/3 h-[750px] flex items-center justify-center overflow-hidden">
                        @if($character->red_picture)
                            <img id="character-image"
                                 src="{{ $character->getImageUrl('red_picture') }}"
                                 alt="{{ $character->name }}"
                                 class="object-contain w-full h-full"
                                 data-red-src="{{ $character->getImageUrl('red_picture') }}"
                                 @if($character->blu_picture)
                                     data-blu-src="{{ $character->getImageUrl('blu_picture') }}"
                                @endif>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <span>Изображение отсутствует</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex ml-4 w-2/3">
                        <div class="flex flex-col gap-4 mr-9">
                            <!-- Кнопки переключения -->
                            <x-primary-button id="red-team-btn"
                                              class="text-custom-ret hover:text-custom-EBE3CB w-32 text-4xl">
                                Крс
                            </x-primary-button>
                            @if($character->blu_picture)
                                <x-primary-button id="blu-team-btn"
                                                  class="text-custom-blu hover:text-custom-EBE3CB w-32 text-4xl">
                                    Син
                                </x-primary-button>
                            @endif
                        </div>

                        <div class="bg-front border-tf rounded-lg p-7 mb-8 min-w-[calc(600px-2rem)]">
                            <div class="flex justify-between border-bottom-EBE3CB w-full mb-2">
                                <h3 class="text-2xl mb-2">{{$character->name}}</h3>
                                <div class="flex items-center mb-2">
                                    @if($character->editor->avatar)
                                        <img class="h-6 w-6 rounded-full mr-2" src="data:image/jpeg;base64,{{ base64_encode($character->editor->avatar) }}" alt="">
                                    @else
                                        <div class="h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                            <span class="text-xs text-gray-600">{{ strtoupper(substr($character->editor->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <span class="text-xs text-gray-500">Последнее изменение: {{ $character->editor->name }}, {{ $character->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <p class="font-tf2">{{ $character->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const characterImage = document.getElementById('character-image');
            const redTeamBtn = document.getElementById('red-team-btn');
            const bluTeamBtn = document.getElementById('blu-team-btn');

            if (!characterImage) return;

            // Обработчики для кнопок
            redTeamBtn.addEventListener('click', function() {
                if (characterImage.dataset.redSrc) {
                    characterImage.src = characterImage.dataset.redSrc;
                    characterImage.alt = "{{ $character->name }} (RED)";
                    redTeamBtn.classList.add('font-bold', 'text-opacity-100');
                    if (bluTeamBtn) {
                        bluTeamBtn.classList.remove('font-bold', 'text-opacity-100');
                    }
                }
            });

            if (bluTeamBtn) {
                bluTeamBtn.addEventListener('click', function() {
                    if (characterImage.dataset.bluSrc) {
                        characterImage.src = characterImage.dataset.bluSrc;
                        characterImage.alt = "{{ $character->name }} (BLU)";
                        bluTeamBtn.classList.add('font-bold', 'text-opacity-100');
                        redTeamBtn.classList.remove('font-bold', 'text-opacity-100');
                    }
                });
            }

            // Инициализация - активна красная команда
            redTeamBtn.classList.add('font-bold', 'text-opacity-100');
        });
    </script>
</x-app-layout>

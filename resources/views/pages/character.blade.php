<x-app-layout>
    <x-slot name="pageTitle">{{ $character->name }}</x-slot>

    <div class="w-3/4 mx-auto flex justify-between my-10">
        <div class="flex">
            <!-- Контейнер для изображения -->
            <div class="relative w-[600px] h-[750px] flex items-center justify-center overflow-hidden">
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

            <div class="flex ml-4">
                <div class="flex flex-col gap-4 mr-9">
                    <!-- Кнопки переключения -->
                    <x-primary-button id="red-team-btn"
                            class="text-custom-ret hover:text-custom-EBE3CB w-32 text-4xl">
                        Крс
                    </x-primary-button>
                    <x-primary-button id="blu-team-btn"
                            class="text-custom-blu hover:text-custom-EBE3CB w-32 text-4xl">
                        Син
                    </x-primary-button>
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
                    // Добавляем/удаляем классы активности
                    redTeamBtn.classList.add('font-bold', 'text-opacity-100');
                    bluTeamBtn.classList.remove('font-bold', 'text-opacity-100');
                }
            });

            bluTeamBtn.addEventListener('click', function() {
                if (characterImage.dataset.bluSrc) {
                    characterImage.src = characterImage.dataset.bluSrc;
                    characterImage.alt = "{{ $character->name }} (BLU)";
                    // Добавляем/удаляем классы активности
                    bluTeamBtn.classList.add('font-bold', 'text-opacity-100');
                    redTeamBtn.classList.remove('font-bold', 'text-opacity-100');
                }
            });

            // Инициализация - активна красная команда
            redTeamBtn.classList.add('font-bold', 'text-opacity-100');
        });
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="pageTitle">Консольные команды</x-slot>

    <div class="w-3/4 mx-auto">
        <div class="bg-front border-tf w-11/12 my-11 px-10 py-7 mx-auto rounded">

            <div class="mb-12">
                <h1 class="border-bottom-EBE3CB text-2xl">
                    Базовые команды для начинающих
                </h1>

                <p class="font-tf2 text-xl mt-5">
                    Абсолютная база для любого начинающего игрока это команды для персонализации. fov_desired - консольная команда, меняющая ширину угла
                    обзора камеры игрока. Максимальное и самое оптимальное значение равно 90 (fov_desired 90). Базовое значение равно 70 (fov_desired 70).
                    viewmodel_fov - схожая команда, которая меняет дальность видимости рук персонажа. По умолчания 54 (viewmodel_fov 54). Оптимального значения
                    нет, каждый подбирает значение под себя
                </p>
            </div>

            @foreach($commands as $command)
                <div class="mb-12">
                    <h1 class="border-bottom-EBE3CB text-2xl">
                        {{ $command->title }}
                    </h1>

                    <p class="font-tf2 text-xl mt-5">
                        {!! nl2br(e($command->text)) !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

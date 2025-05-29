<x-app-layout>
    <x-slot name="pageTitle">Главная</x-slot>

    <div class="w-3/4 mx-auto my-16">
        <h2 class="mb-10 text-4xl text-center">Добро пожаловать! Выберите статью</h2>

        <div class="bg-front border-tf">
            <div class="flex justify-between gap-8 px-16 py-6">
                @foreach($characters as $character)
                    <a href="{{ route('character.show', $character->id) }}" class="character group flex flex-col items-center">
                        <span class="text-8xl group-hover:text-custom-text-hover font-tf2icons">
                            {{ $character->getIconLetter() }}
                        </span>
                        <span class="text-2xl mt-5 group-hover:text-custom-text-hover">
                            {{ $character->name }}
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="flex justify-between px-32 my-12 py-6">
                <a href="{{route('items')}}" class="group flex flex-col items-center">
                    <span class="text-8xl group-hover:text-custom-text-hover font-tf2icons2">P</span>
                    <span class="text-2xl mt-5 group-hover:text-custom-text-hover">Предметы</span>
                </a>
                <a href="{{route('bugs_list')}}" class="group flex flex-col items-center">
                    <span class="text-8xl group-hover:text-custom-text-hover font-tf2icons2">_</span>
                    <span class="text-2xl mt-5 group-hover:text-custom-text-hover">Баги и фишки</span>
                </a>
                <a href="{{route('modes')}}" class="group flex flex-col items-center">
                    <span class="text-8xl group-hover:text-custom-text-hover font-tf2icons2">M</span>
                    <span class="text-2xl mt-5 group-hover:text-custom-text-hover">Игровые режимы</span>
                </a>
                <a href="{{route('histories')}}" class="group flex flex-col items-center">
                    <span class="text-8xl group-hover:text-custom-text-hover font-tf2icons3">;</span>
                    <span class="text-2xl mt-5 group-hover:text-custom-text-hover">История игры</span>
                </a>
                <a href="{{route('console')}}" class="group flex flex-col items-center">
                    <span class="text-8xl group-hover:text-custom-text-hover font-tf2icons3">.</span>
                    <span class="text-2xl mt-5 group-hover:text-custom-text-hover">Консоль</span>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

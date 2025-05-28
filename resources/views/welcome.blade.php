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

            <div class="flex justify-between px-32 mb-12 py-6">
                <a href="{{route('items')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons2">P</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Предметы</h2> </a>
                <a href="{{route('bugs_list')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons2">_</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Баги и фишки</h2> </a>
                <a href="{{route('modes')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons2">M</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Игровые режимы</h2> </a>
                <a href="{{route('histories')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons3">;</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">История игры</h2> </a>
                <a href="{{route('console')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons3">.</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Консоль</h2> </a>
            </div>
        </div>
    </div>
</x-app-layout>

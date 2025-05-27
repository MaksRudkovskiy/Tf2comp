<x-app-layout>

    <x-slot name="pageTitle">Главная</x-slot>

        <div class="w-3/4 mx-auto my-16">
            <h2 class="mb-10 text-4xl text-center">Добро пожаловать! Выберите статью</h2>

            <div class="bg-front border-tf">

                <div class="flex justify-between px-16 mt-12 py-6">
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">A</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Скаут</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">B</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Солдат</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">C</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Пиро</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">D</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Демо</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">E</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Хэви</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">F</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Инжинер</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">G</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Медик</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">H</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Снайпер</h2> </a>
                    <a href="{{route('character')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons">I</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Шпион</h2> </a>
                </div>

                <div class="flex justify-between px-32 mb-12 py-6">

                    <a href="{{route('items')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons2">P</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Предметы</h2> </a>
                    <a href="{{route('bugs_list')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons2">_</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Баги и фишки</h2> </a>
                    <a href="{{route('modes')}}" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons2">M</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Игровые режимы</h2> </a>
                    <a href="#" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons3">;</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">История игры</h2> </a>
                    <a href="#" class="character text-8xl"> <h2 class="hover:text-custom-text-hover text-center font-tf2icons3">.</h2>  <h2 class="text-2xl mt-5 hover:text-custom-text-hover">Консоль</h2> </a>
                </div>

            </div>

        </div>

</x-app-layout>

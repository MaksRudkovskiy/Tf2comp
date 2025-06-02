<x-admin-layout>
    <x-slot name="pageTitle">Редактирование {{ $character->name }}</x-slot>

    <!-- Вывод ошибок валидации -->
    @if($errors->any())
        <div class="w-3/4 mx-auto mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-3/4 mx-auto my-16">
        <div class="bg-front border-tf rounded-lg p-8">

            <h1 class="border-bottom-EBE3CB text-2xl">
                {{$character->name}} - Редактирование
            </h1>

            <form method="POST" class="mt-5" action="{{ route('admin.characters.update', $character) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex my-4 gap-x-4">

                    <div class="relative group">
                        <label for="red_picture" class="cursor-pointer">
                            <div class="w-32 h-32 border-2 border-red-600 rounded-lg flex items-center justify-center overflow-hidden bg-custom-ret hover:bg-gray-200 transition">
                                @if($character->red_picture)
                                    <img src="{{ asset('storage/' . $character->red_picture) }}"
                                         alt="{{ $character->name }} (RED)"
                                         class="object-contain w-full h-full">
                                @else
                                    <div class="text-red-600 text-4xl">+</div>
                                @endif
                            </div>
                            <div class="absolute inset-0 opacity-0">
                                <x-file-input id="red_picture" name="red_picture" class="w-full h-full" accept="image/jpeg,image/png" />
                            </div>
                        </label>
                    </div>

                    <div class="relative group">
                        <label for="blu_picture" class="cursor-pointer">
                            <div class="w-32 h-32 border-2 border-blue-600 rounded-lg flex items-center justify-center overflow-hidden bg-custom-blu hover:bg-gray-200 transition">
                                @if($character->blu_picture)
                                    <img src="{{ asset('storage/' . $character->blu_picture) }}"
                                         alt="{{ $character->name }} (BLU)"
                                         class="object-contain w-full h-full">
                                @else
                                    <div class="text-blue-600 text-4xl">+</div>
                                @endif
                            </div>
                            <div class="absolute inset-0 opacity-0">
                                <x-file-input id="blu_picture" name="blu_picture" class="w-full h-full" accept="image/jpeg,image/png" />
                            </div>
                        </label>
                    </div>

                </div>

                <div>
                    <div>
                        <div class="mb-6">
                            <x-input-label for="description" class="text-xl" value="Описание" />
                            <x-text-area name="description"
                                         class="mt-1 block w-full h-64"
                                         required value="{{$character->description}}"
                            >{{ old('description', $character->description) }}</x-text-area>
                        </div>


                    </div>
                </div>
                <div class="flex text-center gap-x-2 items-center">
                    <div class="flex gap-4">
                        <x-primary-button class="bg-main" type="submit">
                            Сохранить изменения
                        </x-primary-button>
                    </div>

                    <a href="{{ route('admin') }}" class="hover:text-custom-text-hover text-lg text-center px-2 py-2">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="{{asset('js/CharacterPreviewChange.js')}}"></script>
</x-admin-layout>

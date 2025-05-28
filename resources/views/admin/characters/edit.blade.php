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
            <form method="POST" action="{{ route('admin.characters.update', $character) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex">

                    <div class="mb-6">
                        <x-input-label value="Изображение RED" />
                        @if($character->red_picture)
                            <img src="{{ asset('storage/' . $character->red_picture) }}"
                                 alt="{{ $character->name }} (RED)"
                                 class="w-64 h-64 object-contain mb-4">
                        @endif
                        <x-file-input name="red_picture" class="mt-1 block w-full" value="" accept="image/jpeg,image/png" />
                    </div>

                    <div class="mb-6">
                        <x-input-label value="Изображение BLU" />
                        @if($character->blu_picture)
                            <img src="{{ asset('storage/' . $character->blu_picture) }}"
                                 alt="{{ $character->name }} (BLU)"
                                 class="w-64 h-64 object-contain mb-4">
                        @endif
                        <x-file-input name="blu_picture" class="mt-1 block w-full" value="{{$character->blue_picture}}" accept="image/jpeg,image/png" />
                    </div>

                </div>

                <div>
                    <div>
                        <div class="mb-6">
                            <x-input-label for="description" value="Описание" />
                            <x-text-area name="description"
                                         class="mt-1 block w-full h-64"
                                         required value="{{$character->description}}"
                            >{{ old('description', $character->description) }}</x-text-area>
                        </div>


                    </div>
                </div>

                <div class="flex gap-4 mt-8">
                    <x-primary-button type="submit">
                        Сохранить изменения
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

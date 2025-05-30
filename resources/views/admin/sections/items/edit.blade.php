<x-admin-layout>
    <x-slot name="pageTitle">Редактировать предмет</x-slot>
    <div class="w-3/4 mx-auto mt-12 h-full block">
        <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <!-- Изображение предмета -->
                <div>
                    <label class="block">Изображение предмета</label>
                    <label class="block mt-2">
                        <div class="w-40 h-40 bg-back border-tf border-dashed flex items-center justify-center cursor-pointer">
                            @if($item->image_path)
                                <img src="{{ asset('storage/'.$item->image_path) }}"
                                     alt="{{ $item->name }}"
                                     class="object-contain w-full h-full">
                            @else
                                <div class="text-center">
                                    <span class="block">Перетащите или</span>
                                    <span class="block">выберите файл</span>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="image" class="hidden">
                    </label>
                </div>

                <!-- Название -->
                <div>
                    <label class="block">Название предмета</label>
                    <input type="text" name="name" value="{{ old('name', $item->name) }}"
                           required maxlength="30" class="w-full px-3 py-2 bg-back border-tf border-tf rounded">
                </div>

                <!-- Описание -->
                <div>
                    <label class="block">Описание</label>
                    <x-text-area name="description" rows="3" required
                                 class="w-full px-3 py-2 rounded">{{ old('description', $item->description) }}</x-text-area>
                </div>

                <!-- Плюсы -->
                <div>
                    <label class="block">Положительные стороны (Upside)</label>
                    <x-text-area name="upside" rows="2"
                                 class="w-full px-3 py-2 rounded">{{ old('upside', $item->upside) }}</x-text-area>
                </div>

                <!-- Минусы -->
                <div>
                    <label class="block">Отрицательные стороны (Downside)</label>
                    <x-text-area name="downside" rows="2"
                                 class="w-full px-3 py-2 rounded">{{ old('downside', $item->downside) }}</x-text-area>
                </div>

                <!-- Персонажи -->
                <div>
                    <label class="block">Кто может использовать</label>
                    <div class="grid grid-cols-3 gap-2 mt-2">
                        @foreach($characters as $character)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="characters[]" value="{{ $character->id }}"
                                    {{ $item->characters->contains($character->id) ? 'checked' : '' }}>
                                <span>{{ $character->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex space-x-2">
                    <x-primary-button type="submit">
                        Обновить
                    </x-primary-button>
                    <a href="{{ route('admin.items') }}"
                       class="hover:text-custom-text-hover text-lg text-center px-2 py-2">
                        Отмена
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>

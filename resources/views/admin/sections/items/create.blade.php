<x-admin-layout>
    <x-slot name="pageTitle">Добавление нового предмета</x-slot>

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
            <h1 class="border-bottom-EBE3CB text-2xl">Добавить новый предмет</h1>

            <form method="POST" class="mt-5" action="{{ route('admin.items.store') }}" enctype="multipart/form-data" x-data="{ showUpside: false, showDownside: false }">
                @csrf

                <!-- Загрузка изображения-->
                <div class="relative group my-4 w-32 h-32">
                    <label for="image" class="cursor-pointer">
                        <div class="w-32 h-32 border-2 border-tf rounded-lg flex items-center justify-center overflow-hidden bg-back transition" id="image-preview">
                            <div class="text-4xl">+</div>
                        </div>
                        <div class="absolute inset-0 opacity-0">
                            <x-file-input id="image" name="image" class="w-full h-full" accept="image/jpeg,image/png" required />
                        </div>
                    </label>
                </div>

                <!-- Основные поля -->
                <div class="space-y-4">
                    <div>
                        <x-input-label for="name" value="Название предмета" />
                        <x-text-input id="name" name="name" class="bg-back border-tf mt-1 block w-full"
                                      value="{{ old('name') }}" required maxlength="30" />
                    </div>

                    <div>
                        <x-input-label for="caption" value="Подпись (краткое описание)" />
                        <x-text-input id="caption" name="caption" class="bg-back border-tf mt-1 block w-full"
                                      value="{{ old('caption') }}" maxlength="100" />
                    </div>

                    <div>
                        <x-input-label for="description" value="Полное описание" />
                        <x-text-area id="description" name="description" class="mt-1 block w-full h-32"
                                     required>{{ old('description') }}</x-text-area>
                    </div>
                </div>

                <!-- Преимущества с чекбоксом -->
                <div class="mt-6 space-y-2" x-data="{ showUpside: false }">
                    <div class="flex items-center">
                        <input type="hidden" name="show_upside" value="0">
                        <input type="checkbox" id="show_upside" name="show_upside" value="1"
                               x-model="showUpside" class="rounded">
                        <x-input-label for="show_upside" value="Добавить преимущества" class="ml-2" />
                    </div>

                    <div x-show="showUpside" class="mt-2">
                        <x-input-label for="upside" value="Преимущества" />
                        <x-text-area id="upside" name="upside" class="mt-1 block w-full h-24"
                                     x-bind:required="showUpside"></x-text-area>
                    </div>
                </div>

                <!-- Недостатки с чекбоксом -->
                <div class="mt-6 space-y-2" x-data="{ showDownside: false }">
                    <div class="flex items-center">
                        <input type="hidden" name="show_downside" value="0">
                        <input type="checkbox" id="show_downside" name="show_downside" value="1"
                               x-model="showDownside" class="rounded">
                        <x-input-label for="show_downside" value="Добавить недостатки" class="ml-2" />
                    </div>

                    <div x-show="showDownside" class="mt-2">
                        <x-input-label for="downside" value="Недостатки" />
                        <x-text-area id="downside" name="downside" class="mt-1 block w-full h-24"
                                     x-bind:required="showDownside"></x-text-area>
                    </div>
                </div>

                <!-- Персонажи -->
                <div class="mt-6">
                    <x-input-label value="Кто может использовать" />
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                        @foreach($characters as $character)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="characters[]" value="{{ $character->id }}"
                                       {{ in_array($character->id, old('characters', [])) ? 'checked' : '' }}
                                       class="rounded">
                                <span>{{ $character->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex text-center gap-x-2 items-center mt-8">
                    <div class="flex gap-4">
                        <x-primary-button class="bg-main" type="submit">
                            Добавить предмет
                        </x-primary-button>
                    </div>

                    <a href="{{ route('admin.items') }}" class="hover:text-custom-text-hover text-lg text-center px-2 py-2">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="{{asset('js/ItemPreviewChange.js')}}"></script>

</x-admin-layout>

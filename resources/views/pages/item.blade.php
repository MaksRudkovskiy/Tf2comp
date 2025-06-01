<x-app-layout>
    <div class="w-3/4 mx-auto">
        <div class="bg-front border-tf w-11/12 my-11 py-7 px-8 mx-auto rounded">
            <form method="GET" action="{{ route('items') }}" class="flex flex-col md:flex-row gap-4 items-center">
                <div class="">
                    <x-text-input
                        name="search"
                        placeholder="Поиск предметов..."
                        value="{{ $search ?? '' }}"
                        class="w-full"
                    />
                </div>
                <div>
                    <select name="character" class="bg-back border-tf rounded px-3 py-2">
                        <option value="">Все классы</option>
                        @foreach($characters as $character)
                            <option value="{{ $character->id }}" {{ request('character') == $character->id ? 'selected' : '' }}>
                                {{ $character->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-primary-button type="submit">Найти</x-primary-button>
                <a href="{{ route('items') }}" class="text-center px-4 text-base py-2 border-tf rounded hover:bg-catalog">
                    Сбросить
                </a>
            </form>

            <div class="flex mt-4">
                <!-- Сетка предметов слева -->
                <div class="grid gap-4 grid-cols-4 max-w-fit" style="min-height: calc(4 * (theme('spacing.28') + 3 * theme('spacing.4')))">
                    @foreach($items as $item)
                        <a href="{{ route('items', [
                            'character' => request('character'),
                            'selected_item' => $item->id,
                            'page' => $items->currentPage(),
                            'search' => request('search')
                        ]) }}"
                           class="w-40 h-28 {{ $selectedItem && $selectedItem->id == $item->id ? 'bg-catalog_selected' : 'bg-catalog' }} flex justify-center items-center">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}"
                                     alt="{{ $item->name }}"
                                     class="max-h-full max-w-full">
                            @endif
                        </a>
                    @endforeach

                    <!-- Пустые ячейки для заполнения сетки -->
                    @for($i = 0; $i < max(0, 16 - $items->count()); $i++)
                        <div class="w-40 h-28 bg-catalog opacity-0"></div>
                    @endfor
                </div>

                <!-- Детали предмета справа -->
                <div class="flex-grow flex flex-col justify-between items-center ml-8">
                    @if($selectedItem)
                        <div class="max-w-96">
                            <h2 class="text-center text-custom-uncommon text-3xl">{{ $selectedItem->name }}</h2>
                            <h3 class="font-tf2 text-center text-custom-A1A1A1">
                                {{ $selectedItem->caption }}
                            </h3>

                            <h3 class="font-tf2 text-center text-lg mt-2 ">
                                {{ $selectedItem->description }}
                            </h3>

                            @if($selectedItem->upside)
                                <h3 class="font-tf2 text-center text-custom-positive font-extralight">
                                    {{ $selectedItem->upside }}
                                </h3>
                            @endif

                            @if($selectedItem->downside)
                                <h3 class="font-tf2 text-center text-custom-ret font-extralight">
                                    {{ $selectedItem->downside }}
                                </h3>
                            @endif
                        </div>

                        <div class="max-w-96">
                            <h3 class="font-tf2">
                                @if($selectedItem->characters->count() > 0)
                                    Может использоваться:
                                    {{ $selectedItem->characters->pluck('name')->implode(', ') }}
                                @endif
                            </h3>
                        </div>
                    @else
                        <p class="text-center">Выберите предмет для просмотра</p>
                    @endif
                </div>
            </div>


            @if($items->hasPages())
                <div class="mt-6 flex items-center gap-4">
                    @if($items->onFirstPage())
                        <span class="px-4 py-2 bg-main border-tf rounded text-gray-500 cursor-not-allowed">
                &laquo;
            </span>
                    @else
                        <a href="{{ $items->previousPageUrl() }}&selected_item={{ $selectedItem->id ?? '' }}&{{ http_build_query(request()->except('page')) }}"
                           class="px-4 py-2 bg-main border-tf rounded hover:bg-catalog transition">
                            &laquo;
                        </a>
                    @endif

                    <span class="px-4 py-2 bg-main border-tf rounded">
            Страница {{ $items->currentPage() }} из {{ $items->lastPage() }}
        </span>

                    @if($items->hasMorePages())
                        <a href="{{ $items->nextPageUrl() }}&selected_item={{ $selectedItem->id ?? '' }}&{{ http_build_query(request()->except('page')) }}"
                           class="px-4 py-2 bg-main border-tf rounded hover:bg-catalog transition">
                            &raquo;
                        </a>
                    @else
                        <span class="px-4 py-2 bg-main border-tf rounded text-gray-500 cursor-not-allowed">
                &raquo;
            </span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

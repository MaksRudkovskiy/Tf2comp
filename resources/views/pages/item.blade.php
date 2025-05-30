<x-app-layout>
    <div class="w-3/4 mx-auto">
        <div class="bg-front border-tf w-11/12 my-11 py-7 px-8 mx-auto rounded">
            <form method="GET" action="{{ route('items') }}" class="mb-4">
                <h1 class="text-2xl">
                    Показать:
                    <select name="character" class="bg-back border-tf text-2xl py-2" onchange="this.form.submit()">
                        <option value="">Все предметы</option>
                        @foreach($characters as $character)
                            <option value="{{ $character->id }}" {{ request('character') == $character->id ? 'selected' : '' }}>
                                {{ $character->name }}
                            </option>
                        @endforeach
                    </select>
                </h1>
            </form>

            <div class="flex mt-4">
                <!-- Сетка предметов слева -->
                <div class="grid gap-4 grid-cols-4 max-w-fit">
                    @foreach($items as $item)
                        <a href="{{ route('items', [
                            'character' => request('character'),
                            'selected_item' => $item->id,
                            'page' => $items->currentPage()
                        ]) }}"
                           class="w-40 h-28 {{ $selectedItem && $selectedItem->id == $item->id ? 'bg-catalog_selected' : 'bg-catalog' }} flex justify-center items-center">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}"
                                     alt="{{ $item->name }}"
                                     class="max-h-full max-w-full">
                            @endif
                        </a>
                    @endforeach
                </div>

                <!-- Детали предмета справа -->
                <div class="flex-grow flex flex-col justify-between items-center ml-8">
                    @if($selectedItem)
                        <div class="max-w-96">
                            <h2 class="text-center text-custom-uncommon text-3xl">{{ $selectedItem->name }}</h2>
                            <h3 class="font-tf2 text-center text-custom-A1A1A1">
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

            <!-- Пагинация -->
            @if($items->hasPages())
                <div class="mt-10 flex  items-center space-x-4">
                    {{-- Previous Page Link --}}
                    @if($items->onFirstPage())
                        <span class="px-4 py-2 bg-gray-200 rounded text-gray-500 cursor-not-allowed">
                &laquo;
            </span>
                    @else
                        <a href="{{ $items->previousPageUrl() }}&selected_item={{ $selectedItem->id ?? '' }}&character={{ request('character') }}"
                           class="px-4 py-2 bg-main border-tf rounded hover:bg-catalog_selected transition">
                            &laquo;
                        </a>
                    @endif

                    {{-- Current Page --}}
                    <span class="px-4 py-2 bg-main border-tf rounded">
            {{ $items->currentPage() }} / {{ $items->lastPage() }}
        </span>

                    {{-- Next Page Link --}}
                    @if($items->hasMorePages())
                        <a href="{{ $items->nextPageUrl() }}&selected_item={{ $selectedItem->id ?? '' }}&character={{ request('character') }}"
                           class="px-4 py-2 bg-main border-tf rounded hover:bg-catalog_selected transition">
                            &raquo;
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-200 rounded text-gray-500 cursor-not-allowed">
                &raquo;
            </span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

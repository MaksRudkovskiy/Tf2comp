<x-admin-layout>
    <x-slot name="pageTitle">Управление предметами</x-slot>

    <div class="w-3/4 mx-auto mt-12 h-full block">
        <div class="mb-6 flex">
            <a href="{{ route('admin.items.create') }}">
                <x-primary-button>
                    + Добавить новый предмет
                </x-primary-button>
            </a>
        </div>
        <!-- Поиск и фильтры -->
        <div class="bg-front border-tf rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.items') }}" class="flex flex-col items-center md:flex-row gap-4">
                <div class="flex-grow">
                    <x-text-input
                        name="search"
                        placeholder="Поиск по названию или описанию"
                        value="{{ request('search') }}"
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
                <x-primary-button type="submit">Применить</x-primary-button>
                <a href="{{ route('admin.items') }}" class="text-center px-4 py-2 border-tf rounded hover:bg-catalog">
                    Сбросить
                </a>
            </form>
        </div>

        <!-- Список предметов -->
        <div class="space-y-4">
            @forelse($items as $item)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div class="flex items-center">
                        @if($item->image_path)
                            <img src="{{ asset('storage/'.$item->image_path) }}"
                                 alt="{{ $item->name }}"
                                 class="w-16 h-16 object-contain mr-4">
                        @endif
                        <div>
                            <h3 class="text-lg">{{ $item->name }}</h3>
                            <p class="font-tf2 mt-1 text-sm">{{ Str::limit($item->description, 100) }}</p>
                            <div class="flex flex-wrap gap-1 mt-1">
                                @foreach($item->characters as $character)
                                    <span class="text-xs bg-back px-2 py-1 rounded">
                                        {{ $character->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.items.edit', $item->id) }}"
                           class="rounded text-sm">
                            <x-primary-button class="bg-main">
                                Редактировать
                            </x-primary-button>
                        </a>
                        <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit"
                                             class="px-3 py-1 rounded"
                                             onclick="return confirm('Удалить этот предмет?')">
                                Удалить
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    @if(request()->has('search'))
                        Ничего не найдено
                    @else
                        Нет добавленных постов
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if($items->hasPages())
            <div class="my-6 flex justify-center items-center gap-4">
                @if($items->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $items->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &laquo;
                    </a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">
                    Страница {{ $items->currentPage() }} из {{ $items->lastPage() }}
                </span>

                @if($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &raquo;
                    </a>
                @else
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &raquo;
                    </span>
                @endif
            </div>
        @endif
    </div>
</x-admin-layout>

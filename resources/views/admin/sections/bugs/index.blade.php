<x-admin-layout>
    <x-slot name="pageTitle">Управление багами и фишками</x-slot>

    <div class="w-3/4 mx-auto my-12 h-full block">

        <div class="mb-6 flex">
            <a href="{{ route('admin.bugs.create') }}">
                <x-primary-button>
                    + Создать новую статью
                </x-primary-button>
            </a>
        </div>

        <div class="bg-front border-tf rounded-lg px-6 py-8 mb-6">
            <form method="GET" action="{{ route('admin.bugs') }}" class="flex">
                <x-text-input
                    name="search"
                    placeholder="Поиск по названию или содержанию"
                    value="{{ request('search') }}"
                    class="w-full"
                />
                <x-primary-button type="submit" class="ml-2">Найти</x-primary-button>
                <a href="{{ route('admin.bugs') }}" class="ml-2 text-center px-4 border-tf rounded hover:bg-catalog">
                    Сбросить
                </a>
            </form>
        </div>

        <div class="space-y-4 my-6">
            @forelse($bugs as $bug)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h3 class="text-lg">{{ $bug->title }}</h3>
                        <p class="font-tf2 mt-1">{{ Str::limit($bug->text, 100) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.bugs.edit', $bug->id) }}"
                           class=" rounded text-sm">
                             <x-primary-button class="bg-custom-block">
                                 Редактировать
                             </x-primary-button>
                        </a>

                        <form action="{{ route('admin.bugs.destroy', $bug->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit"
                                    class="px-3 py-1 rounded"
                                    onclick="return confirm('Удалить эту статью?')">
                                Удалить
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    Нет статей о багах и фишках
                </div>
            @endforelse
        </div>

        @if($bugs->hasPages())
            <div class="mt-6 flex justify-center items-center gap-4">
                @if($bugs->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $bugs->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &laquo;
                    </a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">
                    Страница {{ $bugs->currentPage() }} из {{ $bugs->lastPage() }}
                </span>

                @if($bugs->hasMorePages())
                    <a href="{{ $bugs->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
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

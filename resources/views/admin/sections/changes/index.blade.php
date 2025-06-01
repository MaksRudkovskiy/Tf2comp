<x-admin-layout>
    <x-slot name="pageTitle">Управление изменениями</x-slot>
    <div class="w-3/4 mx-auto my-12 h-full block">
        <div class="mb-6 flex">
            <a href="{{ route('admin.changes.create') }}">
                <x-primary-button>
                    + Добавить изменения
                </x-primary-button>
            </a>
        </div>

        <div class="bg-front border-tf rounded-lg px-6 py-8 mb-6">
            <form method="GET" action="{{ route('admin.changes') }}" class="flex">
                <x-text-input
                    name="search"
                    placeholder="Поиск по названию или содержанию"
                    value="{{ request('search') }}"
                    class="w-full"
                />
                <x-primary-button type="submit" class="ml-2">Найти</x-primary-button>
                <a href="{{ route('admin.changes') }}" class="ml-2 text-center px-4 border-tf rounded hover:bg-catalog">
                    Сбросить
                </a>
            </form>
        </div>

        <div class="space-y-4">
            @forelse($changes as $change)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h3 class="text-lg">{{ $change->title }}</h3>
                        <p class="font-tf2 mt-1">{{ Str::limit($change->text, 100) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.changes.edit', $change->id) }}"
                           class=" rounded text-sm">
                            <x-primary-button class="bg-main">
                                Редактировать
                            </x-primary-button>
                        </a>

                        <form action="{{ route('admin.changes.destroy', $change->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit"
                                             class="px-3 py-1 rounded"
                                             onclick="return confirm('Удалить эти изменения?')">
                                Удалить
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    Нет добавленных изменений
                </div>
            @endforelse
        </div>

        @if($changes->hasPages())
            <div class="mt-6 flex justify-center items-center gap-4">
                @if($changes->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $changes->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &laquo;
                    </a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">
                    Страница {{ $changes->currentPage() }} из {{ $changes->lastPage() }}
                </span>

                @if($changes->hasMorePages())
                    <a href="{{ $changes->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
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

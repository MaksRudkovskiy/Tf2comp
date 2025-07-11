<x-admin-layout>
    <x-slot name="pageTitle">Управление игровыми режимами</x-slot>
    <div class="w-3/4 mx-auto my-12 h-full block">
        <div class="mb-6 flex">
            <a href="{{ route('admin.modes.create') }}">
                <x-primary-button>
                    + Добавить новый режим
                </x-primary-button>
            </a>
        </div>

        <div class="bg-front border-tf rounded-lg px-6 py-8 mb-6">
            <form method="GET" action="{{ route('admin.modes') }}" class="flex">
                <x-text-input
                    name="search"
                    placeholder="Поиск по названию или содержанию"
                    value="{{ request('search') }}"
                    class="w-full"
                />
                <x-primary-button type="submit" class="ml-2">Найти</x-primary-button>
                <a href="{{ route('admin.modes') }}" class="ml-2 text-center px-4 border-tf rounded hover:bg-catalog">
                    Сбросить
                </a>
            </form>
        </div>

        <div class="space-y-4">
            @forelse($modes as $mode)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h3 class="text-lg">{{ $mode->title }}</h3>
                        <p class="font-tf2 mt-1">{{ Str::limit($mode->text, 100) }}</p>
                        <div class="flex items-center mt-2">
                            @if($mode->editor->avatar)
                                <img class="h-6 w-6 rounded-full mr-2" src="data:image/jpeg;base64,{{ base64_encode($mode->editor->avatar) }}" alt="">
                            @else
                                <div class="h-6 w-6 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                                    <span class="text-xs text-gray-600">{{ strtoupper(substr($mode->editor->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="text-xs text-gray-500">Последнее изменение: {{ $mode->editor->name }}, {{ $mode->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.modes.edit', $mode->id) }}"
                           class=" rounded text-sm">
                            <x-primary-button class="bg-block">
                                Редактировать
                            </x-primary-button>
                        </a>

                        <form action="{{ route('admin.modes.destroy', $mode->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit"
                                             class="px-3 py-1 rounded"
                                             onclick="return confirm('Удалить этот режим?')">
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

        @if($modes->hasPages())
            <div class="mt-6 flex justify-center items-center gap-4">
                @if($modes->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $modes->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &laquo;
                    </a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">
                    Страница {{ $modes->currentPage() }} из {{ $modes->lastPage() }}
                </span>

                @if($modes->hasMorePages())
                    <a href="{{ $modes->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
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

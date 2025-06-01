<x-admin-layout>
    <x-slot name="pageTitle">Управление игровыми режимами</x-slot>
    <div class="w-3/4 mx-auto mt-12 h-full block">
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
    </div>
</x-admin-layout>

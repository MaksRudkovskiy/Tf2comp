<x-admin-layout>
    <x-slot name="pageTitle">Управление историческими статьями</x-slot>
    <div class="w-3/4 mx-auto mt-12 h-full block">
        <div class="mb-6 flex">
            <a href="{{ route('admin.histories.create') }}">
                <x-primary-button>
                    + Создать новую статью
                </x-primary-button>
            </a>
        </div>

        <div class="space-y-4">
            @forelse($histories as $history)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h3 class="text-lg">{{ $history->title }}</h3>
                        <p class="font-tf2 mt-1">{{ Str::limit($history->text, 100) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.histories.edit', $history->id) }}"
                           class=" rounded text-sm">
                            <x-primary-button class="bg-main">
                                Редактировать
                            </x-primary-button>
                        </a>

                        <form action="{{ route('admin.histories.destroy', $history->id) }}" method="POST">
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
                    Нет исторических статей
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>

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
                            <p class="font-tf2 mt-1">{{ Str::limit($item->description, 100) }}</p>
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
                    Нет добавленных предметов
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>

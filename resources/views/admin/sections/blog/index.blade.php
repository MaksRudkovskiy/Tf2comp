<x-admin-layout>
    <x-slot name="pageTitle">Управление блогом</x-slot>
    <div class="w-3/4 mx-auto mt-12 h-full block">
        <div class="mb-6 flex">
            <a href="{{ route('admin.blog.create') }}">
                <x-primary-button>
                    + Добавить новый пост
                </x-primary-button>
            </a>
        </div>

        <div class="space-y-4">
            @forelse($posts as $post)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h3 class="text-lg">{{ $post->title }}</h3>
                        <p class="font-tf2 mt-1">{{ Str::limit($post->text, 100) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.blog.edit', $post->id) }}"
                           class=" rounded text-sm">
                            <x-primary-button class="bg-main">
                                Редактировать
                            </x-primary-button>
                        </a>

                        <form action="{{ route('admin.blog.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit"
                                             class="px-3 py-1 rounded"
                                             onclick="return confirm('Удалить этот пост?')">
                                Удалить
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    Нет добавленных постов
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>

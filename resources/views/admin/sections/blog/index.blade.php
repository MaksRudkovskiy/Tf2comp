<x-admin-layout>
    <x-slot name="pageTitle">Управление блогом</x-slot>
    <div class="w-3/4 mx-auto my-12 h-full block">

        <div class="mb-6 flex">
            <a href="{{ route('admin.blog.create') }}">
                <x-primary-button>
                    + Добавить новый пост
                </x-primary-button>
            </a>
        </div>

        <div class="bg-front border-tf rounded-lg px-6 py-8 mb-6">
            <form method="GET" action="{{ route('admin.blog') }}" class="flex">
                <x-text-input
                    name="search"
                    placeholder="Поиск по названию или содержанию"
                    value="{{ request('search') }}"
                    class="w-full"
                />
                <x-primary-button type="submit" class="ml-2">Найти</x-primary-button>
                <a href="{{ route('admin.blog') }}" class="ml-2 text-center px-4 border-tf rounded hover:bg-catalog">
                    Сбросить
                </a>
            </form>
        </div>

        <div class="space-y-4 my-4">
            @forelse($posts as $post)
                <div class="bg-front border-tf p-4 rounded-lg shadow flex justify-between items-center">
                    <div>
                        <h3 class="text-lg">{{ $post->title }}</h3>
                        <p class="font-tf2 mt-1">{{ Str::limit($post->text, 100) }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.blog.edit', $post->id) }}"
                           class="rounded text-sm">
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
                    @if(request()->has('search'))
                        Ничего не найдено
                    @else
                        Нет добавленных постов
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Пагинация -->
        @if($posts->hasPages())
            <div class="mt-6 flex justify-center items-center gap-4">
                @if($posts->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &laquo;
                    </a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">
                    Страница {{ $posts->currentPage() }} из {{ $posts->lastPage() }}
                </span>

                @if($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
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

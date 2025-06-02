<x-admin-layout>

    <div class="mx-auto w-3/4 py-8">
        <!-- Поиск -->
        <div class="bg-front border-tf rounded-lg p-6 mb-6">
            <form method="GET" action="{{ route('admin.users') }}" class="flex flex-col items-center md:flex-row gap-4">
                <div class="flex-grow">
                    <x-text-input
                        name="search"
                        placeholder="Поиск по имени или email"
                        value="{{ request('search') }}"
                        class="w-full"
                    />
                </div>
                <x-primary-button class="bg-main" type="submit">Поиск</x-primary-button>
                <a href="{{ route('admin.users') }}" class="text-center px-4 py-2 border-tf rounded text-base bg-main hover:text-custom-text-hover">
                    Сбросить
                </a>
            </form>
        </div>

        <!-- Таблица пользователей -->
        <div class="bg-front border-tf rounded overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-front">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                        Имя
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                        Роль
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                        Статус
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs uppercase tracking-wider">
                        Действия
                    </th>
                </tr>
                </thead>
                <tbody class="bg-front divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr class="@if($user->isBanned())  @endif">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($user->avatar)
                                        <img class="h-10 w-10 rounded-full" src="data:image/jpeg;base64,{{ base64_encode($user->avatar) }}" alt="">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-gray-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium">{{ $user->name }}</div>
                                    <div class="text-sm">ID: {{ $user->id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->isAdmin())
                                <span class="px-3 py-0.5 inline-flex text-xs leading-5 font-semibold rounded border-tf bg-back">
                                        Администратор
                                    </span>
                            @elseif($user->isModerator())
                                <span class="px-3 py-0.5 inline-flex text-xs leading-5 font-semibold rounded border-tf bg-back">
                                        Модератор
                                    </span>
                            @else
                                <span class="px-3 py-0.5 inline-flex text-xs leading-5 font-semibold rounded border-tf bg-back">
                                        Пользователь
                                    </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($user->isBanned())
                                <span class="text-red-600">Заблокирован</span>
                                <div class="text-xs text-gray-500" title="{{$user->ban_reason}}">Причина: {{ Str::limit($user->ban_reason, 15) }}</div>
                            @else
                                <span class="text-green-600">Активен</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if(!$user->isAdmin()) {{-- Не позволяем блокировать админов --}}
                            @if($user->isBanned())
                                <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900">Разблокировать</button>
                                </form>
                            @else
                                <button onclick="showBanForm({{ $user->id }})" class="text-red-600 hover:text-red-900">Заблокировать</button>
                            @endif
                            @endif
                        </td>
                    </tr>

                @empty
                     <tr> <td class="py-4 pl-2">Нету пользователей с такими данными</td> </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        @if($users->hasPages())
            <div class="mt-6 flex justify-center items-center gap-4">
                @if($users->onFirstPage())
                    <span class="px-4 py-2 bg-front border-tf rounded text-gray-500 cursor-not-allowed">
                        &laquo;
                    </span>
                @else
                    <a href="{{ $users->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                       class="px-4 py-2 bg-front border-tf rounded hover:bg-catalog transition">
                        &laquo;
                    </a>
                @endif

                <span class="px-4 py-2 bg-front border-tf rounded">
                    Страница {{ $users->currentPage() }} из {{ $users->lastPage() }}
                </span>

                @if($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
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

    <div id="banFormContainer" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-front rounded-lg p-6 max-w-md w-full">
            <h3 class="text-lg font-medium mb-4">Блокировка пользователя</h3>
            <form id="banForm" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label for="ban_reason" class="block text-sm font-medium">Причина блокировки</label>
                    <textarea id="ban_reason" name="ban_reason" rows="3"
                              class="mt-1 block w-full border border-tf bg-back font-tf2 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="hideBanForm()" class="px-4 py-2 border border-tf rounded-md text-sm hover:text-custom-text-hover bg-back">
                        Отмена
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium bg-red-600 hover:bg-red-700">
                        Заблокировать
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript для работы формы -->
    <script>
        function showBanForm(userId) {
            const formContainer = document.getElementById('banFormContainer');
            const form = document.getElementById('banForm');

            // Устанавливаем правильный action для формы
            form.action = `/admin/users/${userId}/ban`;

            // Показываем форму
            formContainer.classList.remove('hidden');
            formContainer.classList.add('flex');
        }

        function hideBanForm() {
            const formContainer = document.getElementById('banFormContainer');
            formContainer.classList.add('hidden');
            formContainer.classList.remove('flex');

            // Очищаем поле ввода
            document.getElementById('ban_reason').value = '';
        }

        // Закрытие формы при клике вне ее области
        document.getElementById('banFormContainer').addEventListener('click', function(e) {
            if (e.target === this) {
                hideBanForm();
            }
        });
    </script>

    <style>
        #banFormContainer {
            transition: opacity 0.3s ease;
        }
    </style>
</x-admin-layout>

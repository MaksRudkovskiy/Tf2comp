<header class="w-full mx-auto py-2 bg-block text-sm border-tf">
    @if (Route::has('login'))
        <nav class="flex items-center mx-auto justify-between gap-4 w-3/4">
            <div class="flex">
                <a href="/" class="hover:text-custom-text-hover">
                    <img src="{{asset('content/img/logos/LOGO.svg')}}" alt="">
                </a>

                <div class="flex justify-between items-center gap-x-16 ml-20">
                    <a href="" class="hover:text-custom-text-hover">О сайте</a>
                    <a href="" class="hover:text-custom-text-hover">ЧАВО</a>
                    <a href="" class="hover:text-custom-text-hover">Нашли ошибку?</a>
                </div>
            </div>

            <div class="relative flex justify-center" x-data="{ isProfileOpen: false }">
                @auth
                    <div class="text-center">
                            <button
                                @click="isProfileOpen = !isProfileOpen"
                                class="inline-block dark:text-[#EDEDEC]"
                            >
                                @if(Auth::user()->avatar)
                                    <img src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->avatar) }}"
                                         alt="User Avatar"
                                         class="rounded-full h-10 w-10 object-cover">
                                @else
                                    <div class="rounded-full bg-custom-EBE3CB h-10 w-10 flex items-center justify-center">
                                        <span class="text-gray-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </button>

                        <div
                            x-show="isProfileOpen"
                            @click.away="isProfileOpen = false"
                            x-cloak
                            class="absolute left-1/2 transform -translate-x-1/2 mt-4 w-84 border-tf transparency-90 rounded"
                            @if(!request()->has('show_profile')) style="display: none;" @endif
                        >
                            <div class="py-3">
                                <!-- Email -->
                                <div class="px-4 text-sm text-center">
                                    {{ Auth::user()->email }}
                                </div>

                                <!-- Аватар -->
                                <img src="data:image/jpeg;base64,{{ base64_encode(Auth::user()->avatar) ?? asset('content/img/pictures/Profile.svg') }}" alt="User Avatar" class="rounded border-tf h-24 w-24 mx-auto my-6 ">

                                <!-- Имя пользователя -->
                                <div class="px-4 text-lg mb-6 font-bold text-center">
                                    {{ Auth::user()->name }}
                                </div>

                                <!-- Кнопка редактирования профиля -->
                                <a href="{{ route('profile.edit') }}">
                                    <button class="px-4 py-1.5 text-lg text-md w-52 bg-front rounded border-tf hover:text-custom-text-hover">Редактировать</button>
                                </a>

                                <!-- Кнопка выхода -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-1.5 mt-2 text-lg bg-custom-danger w-52 rounded border-tf hover:text-custom-text-hover">
                                        Выйти
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    @if (Route::has('register'))
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 text-2xl hover:text-custom-text-hover">
                            регистрация
                        </a>
                    @endif

                    <a
                        href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 text-2xl bg-front rounded border-tf hover:text-custom-text-hover"
                    >
                        Вход
                    </a>
                @endauth
            </div>
        </nav>
    @endif
</header>

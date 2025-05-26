<header class="w-full mx-auto py-2 bg-block text-sm border-tf">
    @if (Route::has('login'))
        <nav class="flex items-center mx-auto justify-between gap-4 w-3/4">

            <div class="flex">
                <a href="" class="hover:text-custom-text-hover">
                    <img src="{{asset('content/img/logos/LOGO.svg')}}" alt="">
                </a>

                <div class="flex justify-between items-center gap-x-16 ml-20">
                    <a href="" class="hover:text-custom-text-hover">О сайте</a>
                    <a href="" class="hover:text-custom-text-hover">ЧАВО</a>
                    <a href="" class="hover:text-custom-text-hover">Нашли ошибку?</a>
                </div>
            </div>

            <div>
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC]"
                    >
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Logout</button>
                    </form>
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

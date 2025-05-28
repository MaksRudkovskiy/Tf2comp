<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle ?? 'TF2compendium' }}</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>
<body class="bg-back flex flex-col min-h-screen">
@include('components.header')
<main class="flex-grow mt-12 max-h-min max-h-700">
    <div>

        <x-nav-tf>
        </x-nav-tf>

        <div class="content min-h-2xl bg-main border-tf">

            <!-- Боковое меню -->
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-front flex flex-col rounded-r-sm py-5 gap-y-2.5 z-10 border-tf md:w-20 w-16">
                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/question_mark.svg')}}" alt="Классы">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Классы
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/weapons.svg')}}" alt="Предметы">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Предметы
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/infinity.svg')}}" alt="Баги">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Баги
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/modes.svg')}}" alt="Режимы">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Режимы
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/history.svg')}}" alt="История">
                    <p class="text-center font-tf2 text-sm mt-1">
                        История
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/console.svg')}}" alt="Консоль">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Консоль
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/changes.svg')}}" alt="Изменения">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Изменения
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/blog.svg')}}" alt="Блог">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Блог
                    </p>
                </button>

                <button class="group">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/mistakes.svg')}}" alt="Ошибки">
                    <p class="text-center font-tf2 text-sm mt-1">
                        Ошибки
                    </p>
                </button>
            </div>

            {{$slot}}
        </div>

    </div>
</main>
@include('components.footer')

</body>
</html>

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
                @php
                    $currentRoute = request()->route()->getName();
                    $isActive = function($route) use ($currentRoute) {
                        // Специальная проверка для админки
                        if ($route === 'admin') {
                            return $currentRoute === 'admin' ||
                                   str_starts_with($currentRoute, 'admin.characters');
                        }
                        // Для histories учитываем возможные варианты
                        if ($route === 'admin.histories') {
                            return $currentRoute === 'admin.histories' ||
                                   str_starts_with($currentRoute, 'admin.histories.');
                        }
                        // Общая проверка для остальных маршрутов
                        return $currentRoute === $route ||
                               str_starts_with($currentRoute, $route . '.');
                    };
                @endphp

                <a href="{{ route('admin') }}" class="group @if($isActive('admin')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/question_mark.svg')}}" alt="Классы">
                    <p class="text-center font-tf2 text-sm mt-1">Классы</p>
                </a>

                <a href="{{ route('admin.items') }}" class="group @if($isActive('admin.items')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/weapons.svg')}}" alt="Предметы">
                    <p class="text-center font-tf2 text-sm mt-1">Предметы</p>
                </a>

                <a href="{{ route('admin.bugs') }}" class="group @if($isActive('admin.bugs')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/infinity.svg')}}" alt="Баги">
                    <p class="text-center font-tf2 text-sm mt-1">Баги</p>
                </a>

                <!-- Остальные пункты меню аналогично -->
                <a href="{{ route('admin.modes') }}" class="group @if($isActive('admin.modes')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/modes.svg')}}" alt="Режимы">
                    <p class="text-center font-tf2 text-sm mt-1">Режимы</p>
                </a>

                <a href="{{ route('admin.histories') }}" class="group @if($isActive('admin.histories')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/history.svg')}}" alt="История">
                    <p class="text-center font-tf2 text-sm mt-1">История</p>
                </a>

                <a href="{{ route('admin.console') }}" class="group @if($isActive('admin.console')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/console.svg')}}" alt="Консоль">
                    <p class="text-center font-tf2 text-sm mt-1">Консоль</p>
                </a>
                @if(Auth::user()->id == 1)
                    <a href="{{ route('admin.changes') }}" class="group @if($isActive('admin.changes')) opacity-100 @else opacity-50 @endif">
                        <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/changes.svg')}}" alt="Изменения">
                        <p class="text-center font-tf2 text-sm mt-1">Изменения</p>
                    </a>

                    <a href="{{ route('admin.blog') }}" class="group @if($isActive('admin.blog')) opacity-100 @else opacity-50 @endif">
                        <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/blog.svg')}}" alt="Блог">
                        <p class="text-center font-tf2 text-sm mt-1">Блог</p>
                    </a>

                    <a href="{{ route('admin.mistakes') }}" class="group @if($isActive('admin.mistakes')) opacity-100 @else opacity-50 @endif">
                        <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/mistakes.svg')}}" alt="Ошибки">
                        <p class="text-center font-tf2 text-sm mt-1">Ошибки</p>
                    </a>

                    @else

                @endif
            </div>

            {{$slot}}
            @if(Auth::user()->id == 1)
            <div class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-front flex flex-col rounded-l-sm py-5 gap-y-2.5 z-10 border-tf md:w-20 w-16">


                <a href="{{ route('admin.stats') }}" class="group @if($isActive('admin.stats')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 text-custom-EBE3CB transition-transform" src="{{asset('content/img/icons/stats.svg')}}" alt="Ошибки">
                    <p class="text-center font-tf2 text-sm mt-1">Статы</p>
                </a>

                <a href="{{ route('admin.users') }}" class="group @if($isActive('admin.users')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 text-custom-EBE3CB transition-transform" src="{{asset('content/img/icons/users.svg')}}" alt="Ошибки">
                    <p class="text-center font-tf2 text-sm mt-1">Учётки</p>
                </a>
            </div>
            @else

            @endif
        </div>

    </div>
</main>
@include('components.footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>

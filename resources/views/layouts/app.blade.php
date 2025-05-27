<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $pageTitle ?? 'TF2compendium' }}</title>

        <!-- Fonts -->
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

                <div class="navigation w-3/4 mx-auto flex gap-x-8">
                    <a class="hover:text-custom-text-hover border-tf-nav text-4xl bg-block px-8 py-3 rounded-t-md" href="/">Справочник</a>
                    <a class="hover:text-custom-text-hover border-tf-nav text-4xl bg-block px-8 py-3 rounded-t-md" href="">Изменения</a>
                    <a class="hover:text-custom-text-hover border-tf-nav text-4xl bg-block px-8 py-3 rounded-t-md" href="">Блог</a>
                </div>

                <div class="content min-h-96 bg-main border-tf">
                     {{$slot}}
                </div>

            </div>
        </main>
        @include('components.footer')

    </body>
</html>

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
                     {{$slot}}
                </div>

            </div>
        </main>
        @include('components.footer')

    </body>
</html>

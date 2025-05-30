<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $pageTitle ?? 'TF2compendium' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>
<body class="bg-back min-h-screen h-full flex items-center justify-center">
    <div class="mx-auto ">

        <a href="{{route('main_page')}}"><img class="block mx-auto mb-8" src="{{asset('content/img/logos/logo.svg')}}" alt=""></a>

        <div class="border-tf rounded bg-block px-6 py-9">
            {{$slot}}
        </div>

    </div>
</body>
</html>

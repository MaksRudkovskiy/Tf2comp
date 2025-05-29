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
                    $isActive = fn($route) => $currentRoute === $route ||
                                             ($route === 'admin' && str_starts_with($currentRoute, 'admin.characters'));
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

                <a href="{{ route('admin.histories') }}" class="group @if($isActive('admin.history')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/history.svg')}}" alt="История">
                    <p class="text-center font-tf2 text-sm mt-1">История</p>
                </a>

                <a href="{{ route('admin.console') }}" class="group @if($isActive('admin.console')) opacity-100 @else opacity-50 @endif">
                    <img class="mx-auto group-hover:scale-110 transition-transform" src="{{asset('content/img/icons/console.svg')}}" alt="Консоль">
                    <p class="text-center font-tf2 text-sm mt-1">Консоль</p>
                </a>

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
            </div>

            {{$slot}}
        </div>

    </div>
</main>
@include('components.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Обработка RED изображения
        setupImageUpload('red_picture');
        // Обработка BLU изображения
        setupImageUpload('blu_picture');

        function setupImageUpload(inputId) {
            const input = document.getElementById(inputId);
            const label = input.closest('label');
            const preview = label.querySelector('div:first-child');

            // Показ превью при выборе файла
            input.addEventListener('change', function(e) {
                if (e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        if (!preview.querySelector('img')) {
                            preview.innerHTML = '';
                            const img = document.createElement('img');
                            img.classList.add('object-cover', 'w-full', 'h-full');
                            preview.appendChild(img);
                        }
                        preview.querySelector('img').src = event.target.result;
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Эффекты при перетаскивании
            preview.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });

            preview.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });

            preview.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                if (e.dataTransfer.files[0]) {
                    input.files = e.dataTransfer.files;
                    const event = new Event('change');
                    input.dispatchEvent(event);
                }
            });
        }
    });
</script>

</body>
</html>

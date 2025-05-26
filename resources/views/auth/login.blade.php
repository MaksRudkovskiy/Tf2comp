<x-authenticate-layout>
    <x-slot name="pageTitle">Вход</x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w400">
        @csrf

        <h1 class="text-center text-3xl mb-9">
            Вход
        </h1>

        <div>
            <x-input-label class="text-custom-EBE3CB text-lg" for="email" :value="__('Эл.Почта')" />
            <x-authenticate-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label class="text-custom-EBE3CB text-lg" for="password" :value="__('Пароль')" />

            <x-authenticate-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-custom-EBE3CB hover:text-custom-text-hover rounded-md" href="{{ route('register') }}">
                {{ __('Нет аккаунта?') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
</x-authenticate-layout>

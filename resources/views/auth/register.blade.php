<x-authenticate-layout>
    <x-slot name="pageTitle">Регистрация</x-slot>
    <form method="POST" action="{{ route('register') }}" class="w400">
        @csrf

        <h1 class="text-center text-3xl">
            Регистрация
        </h1>

        <!-- Name -->
        <div>
            <x-input-label for="name" class="text-custom-EBE3CB text-lg" :value="__('Имя')" />
            <x-authenticate-input id="name" class="" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" class="text-custom-EBE3CB text-lg" :value="__('Эл.Почта')" />
            <x-authenticate-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="text-custom-EBE3CB text-lg" :value="__('Пароль')" />

            <x-authenticate-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-custom-EBE3CB hover:text-custom-text-hover rounded-md" href="{{ route('login') }}">
                {{ __('Уже зарегистрированы?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Регистрация') }}
            </x-primary-button>
        </div>
    </form>
</x-authenticate-layout>

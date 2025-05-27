<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Удаление аккаунта') }}
        </h2>

        <p class="mt-1 text-sm font-tf2">
            {{ __('В случае удаления аккаунта вся ваша информация будет утеряна и вы не сможете больше получить к ней доступ. Для продолжения необходимо ввести пароль от аккаунта') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Удалить аккаунт') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-main border-tf">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium">
                {{ __('Вы уверены что хотите удалить свой аккаунт?') }}
            </h2>

            <p class="mt-1 text-sm font-tf2">
                {{ __('В случае удаления аккаунта вся ваша информация будет утеряна и вы не сможете больше получить к ней доступ. Для продолжения необходимо ввести пароль от аккаунта') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-authenticate-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-primary-button x-on:click="$dispatch('close')">
                    {{ __('Отмена') }}
                </x-primary-button>

                <x-danger-button class="ms-3">
                    {{ __('Удалить аккаунт') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

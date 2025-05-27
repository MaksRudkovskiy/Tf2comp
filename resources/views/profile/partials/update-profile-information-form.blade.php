<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Редактирование информации профиля') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-4">
            @if($user->avatar)
                <img src="data:image/jpeg;base64,{{ base64_encode($user->avatar) }}"
                     alt="User Avatar"
                     class="h-20 w-20 rounded object-cover">
            @else
                <div class="h-20 w-20 rounded-full bg-custom-EBE3CB flex items-center justify-center">
                    <span class="text-gray-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
            @endif

            <div>
                <x-input-label for="avatar" :value="__('Аватар')" />
                <x-text-input id="avatar" name="avatar" type="file" class="border-tf bg-" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-authenticate-input id="name" name="name" type="text" class="mt-1 block w-full"
                                  :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-main">{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm">
                    {{ __('Сохранено.') }}
                </p>
            @endif
        </div>
    </form>
</section>

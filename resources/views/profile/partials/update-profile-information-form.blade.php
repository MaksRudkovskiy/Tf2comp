<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Редактирование информации профиля') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="gap-4">

            <div>
                <x-input-label for="avatar" :value="__('Аватар')" />
                <x-input-error class="my-2" :messages="$errors->get('avatar')" />
            </div>
            <div class="relative group w-20 h-20">
                <label for="avatar" class="cursor-pointer">
                    <div class="w-20 h-20 rounded flex items-center justify-center overflow-hidden bg-back border-2 border-tf transition" id="avatar-preview">
                        @if($user->avatar)
                            <img src="data:image/jpeg;base64,{{ base64_encode($user->avatar) }}"
                                 alt="User Avatar"
                                 class="object-cover w-full h-full">
                        @else
                            <div class="h-full w-full bg-custom-EBE3CB flex items-center justify-center">
                                <span class="text-gray-600 text-2xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="absolute inset-0 opacity-0">
                        <x-file-input id="avatar" name="avatar" class="w-full h-full" accept="image/jpeg,image/png" />
                    </div>
                </label>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatar-preview');

            avatarInput.addEventListener('change', function(e) {
                if (e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        avatarPreview.innerHTML = '';
                        const img = document.createElement('img');
                        img.src = event.target.result;
                        img.classList.add('object-cover', 'w-full', 'h-full');
                        avatarPreview.appendChild(img);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });
        });
    </script>

</section>

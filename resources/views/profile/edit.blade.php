<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <x-slot name="pageTitle">Редактирование профиля</x-slot>

    <div class="my-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-front border-tf shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-front border-tf shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.user-mistakes-list')
                </div>
            </div>
            @if($user->role == 1 || $user->role == 2)

            @else
            <div class="p-4 sm:p-8 bg-front border-tf shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            @endif
        </div>
    </div>
</x-app-layout>

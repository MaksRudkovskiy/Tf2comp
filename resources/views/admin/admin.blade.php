<x-admin-layout>
    <x-slot name="pageTitle">Админка</x-slot>

    <div class="w-3/4 mx-auto my-32 h-full block">
        <div class="bg-front border-tf w-full flex flex-col py-7 rounded">
            <div class="flex justify-between px-16 my-16">
                @foreach($characters as $character)
                    <div class="group character flex flex-col gap-y-2 items-center">
                        <a href="{{ route('admin.characters.edit', $character->id) }}">
                            <h2 class="text-8xl group-hover:text-custom-text-hover text-center font-tf2icons">
                                {{ $character->getIconLetter() }}
                            </h2>
                            <h2 class="text-2xl mt-5 group-hover:text-custom-text-hover text-center">
                                {{ $character->name }}
                            </h2>
                            <x-primary-button class="text-2xs py-3 mt-2 group-hover:text-custom-text-hover">Редактировать</x-primary-button>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-admin-layout>

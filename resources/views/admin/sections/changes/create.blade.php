<x-admin-layout>
    <x-slot name="pageTitle">Добавить изменения</x-slot>
    <div class="w-3/4 mx-auto mt-12 h-full block">
        <form action="{{ route('admin.changes.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block">Версия (например V1.0)</label>
                    <input type="text" name="title" required maxlength="25"
                           class="w-full px-3 py-2 bg-back border-tf border-tf rounded">
                </div>
                <div>
                    <label class="block">Список изменений (каждый пункт с новой строки)</label>
                    <x-text-area name="text" rows="10" required
                                 class="w-full px-3 py-2 rounded font-mono"></x-text-area>
                </div>
                <div class="flex space-x-2">
                    <x-primary-button type="submit">
                        Добавить
                    </x-primary-button>
                    <a href="{{ route('admin.changes') }}"
                       class="hover:text-custom-text-hover text-lg text-center px-2 py-2">
                        Отмена
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>

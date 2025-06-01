<x-admin-layout>
    <x-slot name="pageTitle">Редактировать изменения</x-slot>
    <div class="w-3/4 mx-auto mt-12 h-full block">
        <form action="{{ route('admin.changes.update', $change->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block">Версия</label>
                    <input type="text" name="title" value="{{ old('title', $change->title) }}"
                           required maxlength="45" class="w-full px-3 py-2 bg-back border-tf border-tf rounded">
                </div>
                <div>
                    <label class="block">Список изменений</label>
                    <x-text-area name="text" rows="10" required
                                 class="w-full px-3 py-2 rounded font-mono" value="{{ old('text', $change->text) }}"></x-text-area>
                </div>
                <div class="flex space-x-2">
                    <x-primary-button type="submit">
                        Обновить
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

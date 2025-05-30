<x-admin-layout>
    <x-slot name="pageTitle">Управление ошибками</x-slot>

    <div class="w-3/4 mx-auto my-16">
        <div class="bg-front border-tf rounded-lg p-8">
            <h1 class="text-2xl mb-6 border-b border-custom-EBE3CB pb-2">Сообщения об ошибках</h1>

            <div class="space-y-4">
                @forelse($mistakes as $mistake)
                    <div class="bg-block p-4 rounded-lg border border-custom-EBE3CB/30 hover:border-custom-EBE3CB/60 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold text-lg">
                                    {{ $mistake->user->name ?? 'Аноним' }}
                                </h3>
                                <p class="text-gray-300 mt-1">{{ \Carbon\Carbon::parse($mistake->date)->format('d.m.Y H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <form method="POST" action="{{ route('admin.mistakes.update', $mistake) }}">
                                    @csrf
                                    @method('PUT')
                                    <select name="status"
                                            onchange="this.form.submit()"
                                            class="bg-front border border-custom-EBE3CB/30 rounded px-2 py-1 text-sm focus:outline-none focus:border-custom-EBE3CB">
                                        <option value="pending" @selected($mistake->status === 'pending')>Ожидание</option>
                                        <option value="rejected" @selected($mistake->status === 'rejected')>Отклонено</option>
                                        <option value="acknowledged" @selected($mistake->status === 'acknowledged')>Осведомлены</option>
                                        <option value="fixed" @selected($mistake->status === 'fixed')>Исправлено</option>
                                    </select>
                                </form>
                                <form method="POST" action="{{ route('admin.mistakes.destroy', $mistake) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-100">{{ $mistake->text }}</p>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400">
                        Нет сообщений об ошибках
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>

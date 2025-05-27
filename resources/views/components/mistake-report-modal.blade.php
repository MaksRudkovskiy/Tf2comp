<div x-data="{ isOpen: false }" class="relative">
    <!-- Кнопка открытия -->
    <a href="#" @click.prevent="isOpen = true" class="hover:text-custom-text-hover">
        Нашли ошибку?
    </a>

    <!-- Модальное окно -->
    <div x-show="isOpen"
         @click.away="isOpen = false"
         class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-main border-tf rounded-lg w-full max-w-4xl">
            <form method="POST" action="{{ route('mistakes.store') }}" class="py-10 px-32 relative">
                <button type="button" @click="isOpen = false" class="absolute right-2 top-2 px-4 py-2 hover:text-custom-text-hover">
                        <img class="hover:text-custom-text-hover" src="{{asset('content/img/icons/close.svg')}}" alt="">
                </button>
                @csrf

                <h2 class="text-2xl font-medium text-center mb-6">
                    Пожалуйста, опишите нашу ошибку
                </h2>

                <div class="mt-4">
                    <textarea name="text" rows="10" cols="10"
                              class="w-full border-tf bg-back rounded p-2 text-custom-EBE3CB"
                              placeholder="Опишите ошибку..."
                              required></textarea>
                </div>

                <input type="hidden" name="date" value="{{ now() }}">
                @auth
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                @endauth

                <div class="mt-7 flex justify-end gap-3">
                    <button type="submit"
                            class="px-16 py-2 text-2xl mx-auto bg-front rounded border-tf hover:text-custom-text-hover">
                        Отправить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

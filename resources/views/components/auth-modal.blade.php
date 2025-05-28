<div x-data="{ isOpen: false }" x-init="isOpen = false" class="relative">
    <!-- Кнопка открытия -->
    <a href="#" @click.prevent="isOpen = true" class="hover:text-custom-text-hover">
        Нашли ошибку?
    </a>

    <!-- Модальное окно -->
    <div x-show="isOpen" @click.away="isOpen = false" style="display: none;" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-main border-tf rounded-lg p-6 relative">
            <button type="button" @click="isOpen = false" class="absolute right-2 top-2 px-4 py-2 hover:text-custom-text-hover">
                <img class="hover:text-custom-text-hover" src="{{asset('content/img/icons/close.svg')}}" alt="">
            </button>
            <h2 class="text-lg font-bold mb-4">Пожалуйста, авторизуйтесь</h2>
            <p class="mb-4 font-tf2">Чтобы отправить сообщение об ошибке, вам нужно войти в систему.</p>
            <div class="flex gap-x-4">
                <a href="{{ route('register') }}" class="inline-block px-5 py-1.5 text-2xl hover:text-custom-text-hover">регистрация</a>
                <a href="{{ route('login') }}" class="inline-block px-5 py-1.5 text-2xl bg-front rounded border-tf hover:text-custom-text-hover">Вход</a>
            </div>
        </div>
    </div>
</div>

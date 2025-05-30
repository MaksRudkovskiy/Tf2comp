<div class="navigation w-3/4 mx-auto flex gap-x-8">
    @php
        $currentRoute = request()->route()->getName();

        // Проверка для справочника (включая все дочерние маршруты)
        $isCompendium = in_array($currentRoute, ['home', 'main_page']) ||
                        str_starts_with($currentRoute, 'character') ||
                        in_array($currentRoute, ['weapons', 'modes', 'items', 'histories', 'history']) ||
                        str_starts_with($currentRoute, 'bugs_') ||
                        $currentRoute === 'console';

        // Проверка для изменений (включая все дочерние маршруты)
        $isChanges = $currentRoute === 'changes' || str_starts_with($currentRoute, 'changes.');

        // Проверка для блога (включая все дочерние маршруты)
        $isBlog = $currentRoute === 'blog' || str_starts_with($currentRoute, 'blog.');

        // Проверка для админки (включая все дочерние маршруты)
        $isAdmin = str_starts_with($currentRoute, 'admin');
    @endphp

    <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isCompendium)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
       href="/">Справочник</a>

    <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isChanges)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
       href="{{route('changes')}}">Изменения</a>

    <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isBlog)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
       href="{{route('blog')}}">Блог</a>

    @auth
        @if(auth()->user()->role === 1 or auth()->user()->role === 2)
            <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isAdmin)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
               href="{{route('admin')}}">Админ</a>
        @endif
    @endauth
</div>

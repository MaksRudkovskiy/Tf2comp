<div class="navigation w-3/4 mx-auto flex gap-x-8">
    @php
        $currentRoute = request()->route()->getName();
        $isCompendium = in_array($currentRoute, ['home', 'main_page', 'character', 'character.show', 'weapons', 'modes', 'items', 'histories', 'history_detail', 'console', 'bugs_list', 'bugs_detail']);
        $isChanges = $currentRoute === 'changes';
        $isBlog = $currentRoute === 'blog';
        $isAdmin = in_array($currentRoute, ['admin', 'admin.characters.edit']);
    @endphp

    <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isCompendium)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
       href="/">Справочник</a>

    <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isChanges)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
       href="{{route('changes')}}">Изменения</a>

    <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isBlog)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
       href="{{route('blog')}}">Блог</a>

    @auth
        @if(auth()->user()->role === 1)
            <a class="text-4xl min-w-72 text-center px-8 py-3 rounded-t-md border-tf-nav bg-block @if($isAdmin)  @else text-custom-EBE3CB/50  @endif hover:text-custom-text-hover"
               href="{{route('admin')}}">Админ</a>
        @endif
    @endauth
</div>

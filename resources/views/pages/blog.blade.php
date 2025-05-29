<x-app-layout>
    <x-slot name="pageTitle">Блог</x-slot>

    <div class="w-3/4 mx-auto">
        @foreach($posts as $post)
            <div class="bg-front border-tf w-11/12 my-11 py-7 px-10 mx-auto rounded">
                <h1 class="border-bottom-EBE3CB text-2xl">
                    {{ $post->title }}
                </h1>

                <p class="font-tf2 mt-5">
                    {!! nl2br(e($post->text)) !!}
                </p>
            </div>
        @endforeach
    </div>
</x-app-layout>

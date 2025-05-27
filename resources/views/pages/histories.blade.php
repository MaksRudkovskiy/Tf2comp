<x-app-layout>

    <x-slot name="pageTitle">История игры</x-slot>

    <div class="w-3/4 mx-auto py-12">

        <div class="flex flex-wrap justify-between gap-20">

            @for($i = 0; $i < 6; $i++ )
                <div class="p-5 bg-front border-tf w-full mw420">
                    <a href="{{route('history_detail')}}">
                        <h2 class="text-xl text-center">
                            Зарождение концептов TF2
                        </h2>

                        <p class="font-tf2 text-lg">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi consequat augue vitae euismod facilisis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam vel ligula et lorem ultricies pellentesque a ut elit. Vestibulum hendrerit odio sapien, eu tempus lectus semper id. Class... <span class="font-tf2build text-lg"> Узнать больше </span>
                        </p>
                    </a>
                </div>
            @endfor

        </div>

    </div>

</x-app-layout>

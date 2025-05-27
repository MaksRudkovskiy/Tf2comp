<x-app-layout>

    <div class="w-3/4 mx-auto">

        <div class="bg-front border-tf w-11/12 my-11 py-7 px-8 mx-auto rounded">

            <div>
                <h1 class="text-2xl">
                    Показать:
                    <select class="bg-back border-transparent text-2xl py-2">
                        <option value="all">Все предметы</option>
                        <option value="scout">Скаут</option>
                        <option value="soldier">Солдат</option>
                    </select>
                </h1>
            </div>

            <div class="flex mt-4">

                <div class="grid gap-4 grid-cols-4 max-w-fit">

                    <div class="w-40 h-28 bg-catalog_selected flex justify-center items-center"><img src="{{asset('content/img/items/kritzkrieg.png')}}" alt=""></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>
                    <div class="w-40 h-28 bg-catalog flex justify-center items-center"></div>

                </div>

                <div class="flex-grow flex flex-col justify-between items-center">
                    <div class="max-w-96">
                        <h2 class="text-center text-custom-uncommon text-3xl">Крицкриг</h2>

                        <h3 class="font-tf2 text-center text-custom-A1A1A1">
                            Медпушка
                        </h3>

                        <h3 class="font-tf2 text-center text-white font-extralight">
                            Уберзаряд гарантирует 100% шанс на криты
                        </h3>

                        <h3 class="font-tf2 text-center text-custom-positive font-extralight">
                            +25% скорость накопления убера
                        </h3>
                    </div>

                    <div class="max-w-96">
                        <h3 class="font-tf2">
                            This item is an achievment reward for completing the
                            medic milestone 2 achievment.
                        </h3>

                        <h3 class="font-tf2">
                            This item can be used by medic
                        </h3>

                        <h3 class="font-tf2">
                            This item is equipped is secondary weapon loadout slot
                        </h3>

                        <h4 class="font-tf2">
                            The following tools can be used on this item: name tag,
                            gift wrap, description tag
                        </h4>
                    </div>
                </div>

            </div>

            <div class="mt-10">

                <div class="flex"><img src="{{asset('content/img/icons/left.svg')}}" alt=""> <h2 class="text-3xl mx-16">1 / ?</h2> <img src="{{asset('content/img/icons/right.svg')}}" alt=""></div>

            </div>

        </div>

    </div>

</x-app-layout>

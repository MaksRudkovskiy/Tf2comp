<section>

    @if($user->is_banned == 1)
        <div class="bg-custom-danger my-2 px-4 py-2 border-tf rounded">
            Вы были заблокированы по причине:
            <span class="font-tf2">{{$user->ban_reason}}</span>
        </div>
    @endif

    <header>
        <h2 class="text-lg">
            {{ __('Ваши сообщения об ошибках') }}
        </h2>

        <p class="mt-1 text-sm font-tf2">
            {{ __('Здесь отображаются все ошибки, которые вы отправили') }}
        </p>
    </header>

    <div class="mt-6 space-y-4">
        @forelse($mistakes as $mistake)
            <div class="p-4 bg-block border border-tf rounded-lg shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm ">
                            {{ $mistake->created_at->format('d.m.Y H:i') }}
                        </p>
                        <p class="mt-1 font-tf2">{{ $mistake->text }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($mistake->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($mistake->status === 'rejected') bg-red-100 text-red-800
                            @elseif($mistake->status === 'acknowledged') bg-blue-100 text-blue-800
                            @elseif($mistake->status === 'fixed') bg-green-100 text-green-800
                            @endif">
                            {{ __("mistakes.status.$mistake->status") }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">
                {{ __('Вы еще не отправляли сообщений об ошибках') }}
            </p>
        @endforelse
    </div>
</section>

@php
    $segments = request()->segments();
    $breadcrumbs = [];
    $url = '';

    foreach ($segments as $segment) {
        $url .= '/' . $segment;
        $breadcrumbs[] = [
            'name' => $segment === 'admin' ? 'Главная' : ucfirst(str_replace('-', ' ', $segment)),
            'url' => $url
        ];
    }
@endphp

@if(count($breadcrumbs) > 1)
    <div class="breadcrumbs px-4 py-2 text-sm text-gray-600">
        @foreach($breadcrumbs as $index => $breadcrumb)
            @if(!$loop->last)
                <a href="{{ $breadcrumb['url'] }}" class="hover:text-custom-text-hover">
                    {{ $breadcrumb['name'] }}
                </a>
                <span class="mx-1">/</span>
            @else
                <span class="text-custom-EBE3CB">{{ $breadcrumb['name'] }}</span>
            @endif
        @endforeach
    </div>
@endif

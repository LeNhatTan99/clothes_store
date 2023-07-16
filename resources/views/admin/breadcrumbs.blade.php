<div class="breadcrumb">
    @if (!empty($breadcrumb) && is_array($breadcrumb))
        @foreach ($breadcrumb as $item)
            @if (!empty($item['title']) && !empty($item['url']))
                @if ($loop->last)
                    <li class="breadcrumb-item active">{{ $item['title'] }}</li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{$item['url']}}">{{ $item['title'] }}</a>
                    </li>
                @endif
            @endif
        @endforeach
    @endif
</div>
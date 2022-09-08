<div>
    @foreach ($menus as $key => $item)
        @if ($item['parent'] != 0)
            @break
        @endif
        @include('partials.menu.menu-item', ['item' => $item])
    @endforeach
</div>

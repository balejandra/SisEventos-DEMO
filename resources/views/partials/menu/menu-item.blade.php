@if ($item['submenu'] == [])
    <li class="nav-item {{ Request::is($item['url'].'*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url($item['url']) }}">
            <i class="nav-icon {{$item['icono']}}"></i>
            <span>{{ $item['name'] }}</span> </a>
    </li>
@else
    <li class="nav-group {{ Request::is($item['url'].'*') ? 'active' : '' }}">
        <a class="nav-link nav-link-padre nav-group-toggle" href="#submenu{{$item['id']}}"  id="a{{$item['id']}}">
            <i class="nav-icon {{$item['icono']}}"></i>
            <span>{{ $item['name'] }}</span>
        </a>
            <ul class="nav-group-items nav-pills" id="submenu{{$item['id']}}" >
            @foreach ($item['submenu'] as $submenu)
                @if ($submenu['submenu'] == [])
                    <li class="nav-item {{ Request::is($submenu['url'].'*') ? 'active' : '' }}" id="hijo{{$submenu['id']}}">
                        <a class="nav-link nav-link-hijo" href="{{url($submenu['url'])}}">
                            <i class="nav-icon {{$submenu['icono']}}"></i>
                            <span>{{ $submenu['name'] }}</span>
                        </a>
                    </li>
                @else
                    @include('partials.menu.menu-item', [ 'item' => $submenu ])
                @endif

            @endforeach
        </ul>
    </li>
@endif


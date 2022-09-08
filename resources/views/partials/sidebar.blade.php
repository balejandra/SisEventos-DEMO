
    <div class="sidebar-brand d-none d-md-flex">
        <a href="{{ route('home') }}">
        <img class="sidebar-brand-full" src="{{asset("images/inea.png")}}" width="30" height="30"
             alt="INEA Logo">
        <img class="sidebar-brand-narrow" src="{{asset("images/inea.png")}}" width="30" height="30"
             alt="INEA Logo">
        </a>
    </div>
    <ul class="sidebar-nav nav-pills" data-coreui="navigation" data-simplebar="">
        @include('partials.menu.menu')
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>



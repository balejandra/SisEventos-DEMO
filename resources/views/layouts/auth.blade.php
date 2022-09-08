<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('titulo' )| {{ config('app.name') }}</title>
    <!-- Bootstrap-->
    <link href="{{asset('assets/vendors/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/zarpesStyle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/dist/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/@coreui/@coreui.css')}}">
    @routes
</head>
<body>
<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</div>

<!-- CoreUI and necessary plugins-->
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/fontawesome/js/all.js')}}"></script>

<script src="{{asset('assets/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendors/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/@coreui/utils/js/coreui-utils.js')}}"></script>
@stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>@yield('titulo' )| {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css')}}">

    <link href="{{asset('assets/vendors/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('assets/DataTables/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/zarpesStyle.css')}}">
    <link rel="stylesheet" href="{{asset('assets/custom.css')}}">

    <link rel="stylesheet" href="{{asset('assets/@coreui/@coreui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/EasyAutocomplete-1.3.5/easy-autocomplete.css')}}">
    <script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
    @routes
</head>
<body>
    <?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    ?>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    @include('partials.sidebar')
</div>
<div class="wrapper d-flex flex-column min-vh-100">
    <header class="header header-sticky mb-4">
        @include('partials/header')

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">

                @yield('content')

            </div>
        </div>


</div>

<footer class="footer">
    @include('partials/footer')
</footer>
</body>
@stack('scripts')
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/jquery/moment.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/dist/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('assets/DataTables/datatables.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('js/zarpeInternacional.js')}}"></script>
<script src="{{asset('assets/fontawesome/js/all.js')}}"></script>
<script src="{{asset('js/dataTables.js')}}"></script>
<script src="{{asset('assets/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.js')}}"></script>
<script src="{{asset('assets/DataTables/DateTime-1.1.2/datetime.js')}}"></script>

<!-- Plugins and scripts required by this view-->
<script src="{{asset('assets/@coreui/coreui/js/coreui.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendors/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/@coreui/utils/js/coreui-utils.js')}}"></script>
<script src="{{asset('assets/bootbox/bootbox.js')}}"></script>
<script src="{{asset('assets/EasyAutocomplete-1.3.5/jquery.easy-autocomplete.js')}}"></script>


</html>

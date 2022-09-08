@extends('layouts.app')
@section("titulo")
{{$titulo}}
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"> {{$titulo}}</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                         <i class="fa fa-building"></i>
                             <strong> {{$titulo}}</strong>
                              @can('crear-establecimientoNautico')
                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{ route('establecimientosNauticos.create') }}">Nuevo</a>
                                
                             </div>
                              @endcan
                         </div>
                         <div class="card-body">
                             @include('publico.establecimientos_nauticos.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection


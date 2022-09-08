@extends('layouts.app')
@section("titulo")
    Menus
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">{{$titulo}}</li>
    </ol>
        </nav>
    </div>
</header>
    <div class="container-fluid">
        <div class="animated fadeIn">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="msj" role="success">
                <button type="button" class="close success-op" data-dismiss="alert" aria-label="close">
                    &times;
                </button>
                {{session('success')}}
            </div>
        @endif


             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             <strong>{{$titulo}}</strong>
                             <div class="card-header-actions">
                                 @can('crear-menu')
                                     <a class="btn btn-primary btn-sm"  href="{{ route('menus.create') }}">Nuevo</a>
                                 @endcan
                                     <a class="btn btn-primary btn-sm"  href="{{ route('menuRols.index') }}">Listado de Roles y Menús</a>
                                     <a class="btn btn-warning btn-sm"  href="{{ route('menuDelete.index') }}">Menús Eliminados</a>
                             </div>
                         </div>
                         <div class="card-body">
                             @include('publico.menus.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection


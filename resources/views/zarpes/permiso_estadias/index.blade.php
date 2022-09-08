@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos de Estadía</li>
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
                             <i class="fas fa-water"></i>
                             <strong>Solicitud de Permisos de Estadía</strong>
                             @can('crear-estadia')
                                 <div class="card-header-actions">
                                     <a class="btn btn-primary btn-sm"  href="{{ route('permisosestadia.create') }}">Nuevo</a>
                                 </div>
                             @endcan
                         </div>
                         <div class="card-body">
                             @include('zarpes.permiso_estadias.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection


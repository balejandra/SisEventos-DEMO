@extends('layouts.app')
@section("titulo")
    Departamentos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Departamentos</li>
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
                             <strong>Departamentos</strong>
                              @can('crear-departamento')
                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{ route('capitanias.create') }}">Nuevo</a>
                                 <a class="btn btn-primary btn-sm"  href="{{ route('capitaniaUsers.index') }}">Usuarios de Departamentos</a>
                             </div>
                              @endcan
                         </div>
                         <div class="card-body">
                             @include('publico.capitanias.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection


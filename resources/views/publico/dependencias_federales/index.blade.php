@extends('layouts.app')
@section("titulo")
    Dependencias Federales
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Dependencias Federales</li>
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
                            <i class="fa fa-map" aria-hidden="true"></i>
                            Dependencias Federales
                            @can('crear-dependencia')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('dependenciasfederales.create') }}">Nuevo</a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('publico.dependencias_federales.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


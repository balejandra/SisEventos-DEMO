@extends('layouts.app')
@section("titulo")
    Tabla de mandos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Tabla de Mandos</li>
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
                            <i class="fas fa-table"></i>
                            <strong>Tabla de Mandos</strong>
                            @can('crear-mando')
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm"  href="{{ route('tablaMandos.create') }}">Nuevo</a>
                            </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('zarpes.tabla_mando.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


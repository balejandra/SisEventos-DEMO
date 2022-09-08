@extends('layouts.app')
@section("titulo")
    Equipos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Equipos</li>
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
                            <i class="fas fa-shield-alt"></i>
                            <strong>Equipos</strong>
                            @can('crear-equipo')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm" href="{{ route('equipos.create') }}">Nuevo</a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('zarpes.equipos.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


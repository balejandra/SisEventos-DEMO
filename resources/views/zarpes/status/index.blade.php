@extends('layouts.app')
@section("titulo")
    Estatus
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Estatus</li>
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
                            <i class="fa fa-clipboard-check fa-lg"></i>
                            <strong>Estatus</strong>
                            @can('crear-status')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm" href="{{ route('status.create') }}">Nuevo</a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            @include('zarpes.status.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


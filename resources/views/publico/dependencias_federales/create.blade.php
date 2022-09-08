@extends('layouts.app')
@section("titulo")
    Dependencias Federales
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('dependenciasfederales.index') !!}">Dependencia Federal</a>
                </li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </nav>
    </div>
    </header>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-map" aria-hidden="true"></i>
                                <strong>Crear Dependencia Federal</strong>
                                <div class="card-header-actions">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3"></div>
                                    <div class=" border col-lg-6 col-md-12 col-sm-12 col-xs-12 p-3">

                                        {!! Form::open(['route' => 'dependenciasfederales.store']) !!}

                                        @include('publico.dependencias_federales.fields')

                                        {!! Form::close() !!}
                                        </div>
                                    <div class=" col-lg-3 col-md-3"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection

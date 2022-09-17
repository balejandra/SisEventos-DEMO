@extends('layouts.app')
@section("titulo")
    Petros
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('petros.index') !!}">Petros</a>
                </li>
                <li class="breadcrumb-item">Crear</li>
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
                                <i class="fas fa-coins"></i>
                                <strong>Crear Petro</strong>
                                <div class="card-header-actions">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">

                                    <div class="col-md-8 border rounded p-3">
                                {!! Form::open(['route' => 'petros.store']) !!}

                                   @include('publico.petros.fields')

                                {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection

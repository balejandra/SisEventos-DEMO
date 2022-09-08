@extends('layouts.app')
@section("titulo")
    {{$titulo}}
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('establecimientosNauticos.index') !!}">{{$titulo}}</a>
                </li>
                <li class="breadcrumb-item">Crear </li>
            </ol>
        </nav>
    </div>
    </header>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                @include('flash::message')
                @if(isset($error))
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            <i class="fa fa-building"></i>
                                <strong>Crear  {{$titulo}}</strong>
                                <div class="card-header-actions">
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 border rounded p-3">
                                    {!! Form::open(['route' => 'establecimientosNauticos.store']) !!}

                                        @include('publico.establecimientos_nauticos.fields')

                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection

@extends('layouts.app')
@section("titulo")
    Notificaciones
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                    <a href="{{ route('notificaciones.index') }}">Notificaciones</a>
                </li>
                <li class="breadcrumb-item">Consulta de Notificación</li>

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
                            <i class="fa fa-bell fa-lg"></i>
                            <strong>Notificaciones</strong>
                            <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{ route('notificaciones.index') }}">Cancelar</a>
                            </div>
                        </div>
                        <div class="card-body ">
                          

                           <div class="row mx-3 mb-0    ">
                                <div class="col-md-3 col-sm-2 col-lg-1 border  p-2 float-right"><b>Fecha:</b></div>
                                <div class="col-md-9 col-sm-10 col-lg-11 border p-2 float-right">
                                {{$notificacion->created_at}}
                                </div>
                           </div>

                           <div class="row mx-3 mb-0 ">
                                <div class="col-md-3 col-sm-12  col-lg-1 border  p-2"><b>Asunto:</b></div>
                                <div class="col-md-9 col-sm-12  col-lg-11 border p-2">
                                {{$notificacion->titulo}}
                                </div>
                           </div>

                           <div class="row mx-3 mt-0 ">
                                <div class="col-md-12 text-center border  p-2"><b>Mensaje</b> </div>
                                <div class="col-md-12 border p-2">
                                {!!$notificacion->texto!!}
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


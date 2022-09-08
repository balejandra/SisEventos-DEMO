@extends('layouts.app')
@section("titulo")
    Error
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active">Error</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="blog_post">
                <div class="img_pod">
                    <img src="{{asset('images/IconoError.png')}}" alt="random image">
                </div>
                <div class="container_copy">
                    <p class="text-unanthorized">Esta sección del Sistema sólo puede ser visitada por usuarios
                        autorizados,
                        para obtener acceso a esta sección del sistema comuníquese con el Administrador del Sistema.</p>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/estadia.js')}}"></script>
    @endpush
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('permisosestadia.index') !!}">Permiso Estadía</a>
                </li>
                <li class="breadcrumb-item">Crear Renovación</li>
            </ol>
        </nav>
    </div>
    </header>
     <div class="container-fluid">
          <div class="animated fadeIn">
              @include('flash::message')
              @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-water"></i>
                                <strong>Renovar Permiso de Estadía</strong>
                                <div class="card-header-actions">
                                    <a href= "{{route('permisosestadia.index')}} " class="btn btn-primary btn-sm">Cancelar</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('zarpes.permiso_estadias.renovacion.renovacionIndicator')
                                {!! Form::model($permiso, ['route' => ['storerenovacion', $permiso->id], 'method' => 'patch','files' => true]) !!}

                                   @include('zarpes.permiso_estadias.renovacion.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection

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
                    <a href="{{ route('dependenciasfederales.index') }}">Dependencia Federal</a>
                </li>
                <li class="breadcrumb-item active">Consulta</li>
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
                                 <strong>Consultar Dependencia Federal</strong>

                                  <div class="card-header-actions">
                                    <a href= "{{route('dependenciasfederales.index')}} " class="btn btn-primary btn-sm">Cancelar</a>
                                </div>
                             </div>
                             <div class="card-body" style="min-height:200px;">
                                 @include('publico.dependencias_federales.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection

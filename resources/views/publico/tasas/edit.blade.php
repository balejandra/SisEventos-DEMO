@extends('layouts.app')
@section("titulo")
    Departamentos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('capitanias.index') !!}">Departamento</a>
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
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit Tasa</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($tasa, ['route' => ['tasas.update', $tasa->id], 'method' => 'patch']) !!}

                              @include('tasas.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection

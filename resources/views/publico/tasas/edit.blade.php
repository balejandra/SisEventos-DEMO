@extends('layouts.app')
@section("titulo")
    Tasas
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('tasas.index') !!}">Tasas</a>
                </li>
                <li class="breadcrumb-item">Editar</li>
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
                              <i class="fas fa-percentage"></i>
                              <strong>Editar Tasa</strong>
                              <div class="card-header-actions">

                              </div>
                          </div>
                          <div class="card-body">
                              <div class="row justify-content-center">

                                  <div class="col-md-8 border rounded p-3">
                              {!! Form::model($tasa, ['route' => ['tasas.update', $tasa->id], 'method' => 'patch']) !!}

                              @include('publico.tasas.fields')

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

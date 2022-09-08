@extends('layouts.app')
@section("titulo")
    Equipos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('equipos.index') !!}">Equipos</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
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
                              <i class="fas fa-shield-alt"></i>
                              <strong>Editar Equipo</strong>
                              <div class="card-header-actions">

                              </div>
                          </div>
                          <div class="card-body">
                              {!! Form::model($equipo, ['route' => ['equipos.update', $equipo->id], 'method' => 'patch']) !!}

                              @include('zarpes.equipos.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection

@extends('layouts.app')
@section("titulo")
    Usuarios de Departamentos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('capitaniaUsers.index') !!}">Usuarios de Departamentos</a>
                </li>
                <li class="breadcrumb-item active">Crear</li>
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
                                <i class="fas fa-user-tie"></i>
                                <strong>Crear Usuario de Departamentos</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 border rounded p-3">
                                {!! Form::open(['route' => 'capitaniaUsers.store']) !!}

                                   @include('publico.capitania_users.fields')

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

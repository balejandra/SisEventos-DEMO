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
                    <a href="{{ route('capitaniaUsers.index') }}">Usuarios de Departamentos</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
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
                              <i class="fas fa-user-tie"></i>
                              <strong>Editar Usuario de Departamentos</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($capitaniaUser, ['route' => ['capitaniaUsers.update', $capitaniaUser->id], 'method' => 'patch']) !!}
                              <div class="row">
                                  <div class="col-md-2"></div>
                                  <div class="col-md-8 border rounded p-3">
                              @include('publico.capitania_users.fieldsedit')
                                  </div>
                                  <div class="col-md-2"></div>
                              </div>
                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection

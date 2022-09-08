@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('users.index') !!}">Usuarios</a>
                </li>
                <li class="breadcrumb-item active1">Editar</li>
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
                              <i class="fa fa-user fa-lg"></i>
                              <strong>Editar Usuario</strong>
                              <div class="card-header-actions">

                              </div>
                          </div>
                          <div class="card-body">
                              {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6  border rounded p-3">
                              @include('publico.users.fields')


                                    </div>
                                    <div class="col-md-3"></div>
                                </div>

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection

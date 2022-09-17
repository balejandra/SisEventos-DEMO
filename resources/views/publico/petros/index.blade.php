@extends('layouts.app')
@section("titulo")
    Petros
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    Petros
                </li>
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
                             <i class="fas fa-coins"></i>
                             <strong>Petros</strong>
                             @can('crear-petros')
                                 <div class="card-header-actions">
                                     <a class="btn btn-primary btn-sm"  href="{{ route('petros.create') }}">Nuevo</a>
                                 </div>
                             @endcan
                         </div>
                         <div class="card-body">
                             @include('publico.petros.table')
                              <div class="pull-right mr-3">

                              </div>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection


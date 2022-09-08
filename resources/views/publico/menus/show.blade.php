@extends('layouts.app')
@section("titulo")
    Menus
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('menus.index') }}">{{$titulo}}</a>
                </li>
                <li class="breadcrumb-item active1">Consulta</li>
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
                             <i class="fa fa-bars fa-lg"></i>
                                 <strong>Consultar {{$titulo}} </strong>
                                 <div class="card-header-actions">
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="my-2">
                                     <div class="container">
                                        @include('publico.menus.show_fields')
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection

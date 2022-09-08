@extends('layouts.app')
@section("titulo")
    Auditoria
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Auditoría</li>
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
                             <i class="fa fa-align-justify"></i>
                             Auditoría
                         </div>
                         <div class="card-body">
                             @include('publico.audits.table')
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection


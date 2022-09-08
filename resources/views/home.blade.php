@extends('layouts.app')
@section("titulo")
    Dashboard
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    Home
                </li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
             
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                          
                         <div class="card-body text-center">
                            <img width="400px"   src="{{asset('images/inea.png')}}" alt="">
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection

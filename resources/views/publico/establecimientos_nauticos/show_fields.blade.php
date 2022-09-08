
 
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="30%" class="bg-light">Nombre</th>
                    <td> {{$estNautico->nombre}} </td>
                </tr>
                <tr>
                    <th class="bg-light">RIF</th>
                    <td> {{$estNautico->RIF}}</td>
                </tr>
                <tr>
                    <th class="bg-light">Capitanía</th>
                    <td> 
                    {{$estNautico->capitania}}
                    </td>
                </tr>
                

            </tbody>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>



 
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2" class="bg-light text-center">Comodoro</th>
                </tr>
            </thead>
            <tbody>
            @if(is_object($user))
                <tr>
                    <th width="30%" class="bg-light">Nombre</th>
                    <td> {{$user->nombres}} {{$user->apellidos}} </td>
                </tr>
               
                <tr>
                    <th class="bg-light">Email</th>
                    <td> 
                        {{$user->email}}
                    </td>
                </tr>
            </tbody>
            @else
            <tr>
                <td colspan="2" class="text-center">Sin comodoro asignado</td>
            </tr> 
            @endif
        </table>
    </div>
    <div class="col-md-2"></div>
</div>



<div class="row d-flex justify-content-center">
<div class="col-md-2"></div>
<div class="text-center col-md-8" >
 
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="{{route('establecimientosNauticos.index')}}" class="btn btn-primary btncancelarZarpes">Cancelar</a>
        </div>
    </div>
</div>

<div class="col-md-2"></div>

</div>


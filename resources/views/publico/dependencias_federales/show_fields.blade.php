 


<div class="row justify-content-center py-3">
    <div class="col-md-8 ">
     
      <table class="table table-bordered" width="80%">
         <tr>
             <td class="bg-light">Nombre</td>
             <td>{{ $dependenciaFederal->nombre }}</td>
         </tr>
         <tr>
             <td class="bg-light">Capitanía</td>
             <td>{{ $capitania }}</td>
         </tr>
         @if(is_object($coordenadas))
         <tr>
             <td class="bg-light">Latitud</td>
             <td>{{$coordenadas[0]->latitud}}</td>
         </tr>
         <tr>
             <td class="bg-light">Longitud</td>
             <td>{{$coordenadas[0]->longitud}}</td>
         </tr>
         
         @endif
     </table>
 

 </div>
</div>
 



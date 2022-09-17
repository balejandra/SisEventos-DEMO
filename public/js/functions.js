function inputcant() {
    if($("#cantidad").is(':checked')){
        $("#cantidad").attr('value', 'true');
    }else{
        $("#cantidad").attr('value', 'false');
    }
}

//-------------------Tooltips----------------------------
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $(".CHALECOS").prop('required', true);

    let elements = document.getElementById(1);
    if (elements) {
        elements.oninvalid = function (e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Marque la casilla, Para generar la solicitud es obligatorio incluir la cantidad de salvavidas que tiene en la embarcación");
            }
        };
        elements.oninput = function (e) {
            e.target.setCustomValidity("");
        };

    } else {
    }
});


function motivoRechazo() {
    $motivo = $("#motivo1 option:selected").text();
    if ($motivo == 'Observaciones en los documentos') {
        table = document.getElementById("inputmotivo");
        table.style.display = 'block';
        $("#motivo1").attr("name","motivofalso");
        $("#motivo2").attr("name","motivo");
        document.querySelector('#motivo2').required = true;

    }else{
        table = document.getElementById("inputmotivo");
        table.style.display = 'none';
        $("#motivo1").attr("name","motivo");
        $("#motivo2").attr("name","motivofalso");
        document.querySelector('#motivo2').required = false;
    }
}

//-------------------------------------------------------------------------------

function agregarCoordenadas(){

var coords=document.getElementById('coords');
let cantAct=coords.getAttribute('data-cant');
cantAct<=0 ? cantAct=1 : cantAct++;


const divrow= document.createElement("div");
divrow.classList.add("row");
divrow.id="coordenadas"+cantAct;

const divids=document.createElement("div");
divids.innerHTML=`<input class="form-control" name="ids[]" type="hidden" >`;

const divlat=document.createElement("div");
divlat.classList.add("form-group", "col-sm-4");
divlat.innerHTML=`
            <input class="form-control" name="latitud[]" id="lat`+cantAct+`" type="text">`;


const divlon=document.createElement("div");
divlon.classList.add("form-group", "col-sm-4");
divlon.innerHTML=`
            <input class="form-control" name="longitud[]" id="lon`+cantAct+`"  type="text">`;

const divbtn=document.createElement("div");
divbtn.classList.add("form-group", "col-sm-3");
divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarCoordenadas(`+cantAct+`,'')" type="button">Borrar</button>`;

divrow.appendChild(divids);
divrow.appendChild(divlat);
divrow.appendChild(divlon);
divrow.appendChild(divbtn);

coords.appendChild(divrow);

coords.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;

}

function eliminarCoordenadas(id, idcoord){

    if(id!=""){
        const div = document.querySelector("#coordenadas"+id);
        div.remove();
    }
    if(idcoord!=""){
       const del = document.querySelector("#deletes"+id);
        del.value=idcoord;
    }

}



//-------------------------------------------------------------------------------

function agregarCoordenadasDF(){

var coords=document.getElementById('coords');
let cantAct=coords.getAttribute('data-cant');
cantAct<=0 ? cantAct=1 : cantAct++;


const divrow= document.createElement("div");
divrow.classList.add("row");
divrow.id="coordenadas"+cantAct;

const divids=document.createElement("div");
divids.innerHTML=`<input class="form-control" name="ids[]" type="hidden" >`;

const divlat=document.createElement("div");
divlat.classList.add("form-group", "col-sm-5");
divlat.innerHTML=`
            <input class="form-control" name="latitud[]" id="lat`+cantAct+`" type="text">`;


const divlon=document.createElement("div");
divlon.classList.add("form-group", "col-sm-5");
divlon.innerHTML=`
            <input class="form-control" name="longitud[]" id="lon`+cantAct+`"  type="text">`;

const divbtn=document.createElement("div");
divbtn.classList.add("form-group", "col-sm-2");
divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarCoordenadas(`+cantAct+`,'')" type="button">Borrar</button>`;

divrow.appendChild(divids);
divrow.appendChild(divlat);
divrow.appendChild(divlon);
divrow.appendChild(divbtn);

coords.appendChild(divrow);

coords.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;

}

function eliminarCoordenadasDF(id, idcoord){

    if(id!=""){
        const div = document.querySelector("#coordenadas"+id);
        div.remove();
    }
    if(idcoord!=""){
       const del = document.querySelector("#deletes"+id);
        del.value=idcoord;
    }

}

//-----------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------

function agregarCargosMandos(){

    var coords1=document.getElementById('coords1');
    let cantAct=coords1.getAttribute('data-cant');
    cantAct<=0 ? cantAct=1 : cantAct++;

    const divrow= document.createElement("div");
    divrow.classList.add("row");
    divrow.id="coordenadas"+cantAct;

    const divids=document.createElement("div");
    divids.innerHTML=`<input class="form-control" name="ids[]" type="hidden" >`;

    const divlat=document.createElement("div");
    divlat.classList.add("form-group", "col-sm-3");
    divlat.innerHTML=`
            <input class="form-control" name="cargo[]" id="cargo`+cantAct+`" type="text" placeholder="Cargo que desempeña" required>`;


    const divlon=document.createElement("div");
    divlon.classList.add("form-group", "col-3");
    divlon.innerHTML=`
            <input class="form-control" name="titulacion_minima[]" id="titmin`+cantAct+`"  type="text" placeholder="Titulación mínima aceptada" required>`;

    const divtitmax=document.createElement("div");
    divtitmax.classList.add("form-group", "col-3");
    divtitmax.innerHTML=`
            <input class="form-control" name="titulacion_maxima[]" id="titmax`+cantAct+`"  type="text" placeholder="Titulación máxima aceptada" required>`;

    const divbtn=document.createElement("div");
    divbtn.classList.add("form-group", "col-sm-2");
    divbtn.innerHTML=`<button class="btn btn-danger" onclick="eliminarCargosMandos(`+cantAct+`,'')" type="button">Borrar</button>`;

    divrow.appendChild(divids);
    divrow.appendChild(divlat);
    divrow.appendChild(divlon);
    divrow.appendChild(divtitmax);
    divrow.appendChild(divbtn);

    coords1.appendChild(divrow);

    coords1.setAttribute('data-cant', cantAct);
//coords.innerHTML=  coords.innerHTML+campos;

}

function eliminarCargosMandos(id, idcoord){

    if(id!=""){
        const div = document.querySelector("#coordenadas"+id);
        div.remove();
    }
    if(idcoord!=""){
        const del = document.querySelector("#deletes"+id);
        del.value=idcoord;
    }

}

//-----------------------------------------------------------------------------------------

//INICIO VALIDACIONES DE PERMISOS DE ZARPES

    function getDataPassengers(tipozarpe) {
        let cedula= document.getElementById('numero_identificacion').value;
        let fechanac= document.getElementById('fecha_nacimiento').value;

        let sexo= document.getElementById('sexo').value;
        let tipodoc= document.getElementById('tipodoc').value;

        let men='';
        var msj= document.getElementById('msj');
        var pass=document.getElementById('pasajeros');
        const asset=msj.getAttribute('data-asset');

         msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif' width='30px'> &nbsp; Comparando datos con registros existentes en SAIME, por favor espere...</div>";

        var div=document.getElementById("dataPassengers");
        cantAct=parseInt(div.getAttribute("data-cant"));
        let pasaporteMayor=document.getElementById('pasaporte_mayor').value;

        if(tipozarpe=='ZI'){


            console.log('ZI pasaporteMayor');
            if(pasaporteMayor==''){
                msj.innerHTML='<div class="alert alert-danger">El documento pasaporte es requerido</div>' ;
                return false;

            }
        }else if(tipozarpe=='ZN'){
            if(pasaporteMayor=='' && tipodoc=="P"){
                msj.innerHTML='<div class="alert alert-danger">El documento pasaporte es requerido</div>' ;
                return false;

            }
        }
        if(cantAct==0){
            pass.innerHTML="";
        }

            if (cedula!="" && fechanac!="" && sexo!="" && tipodoc!="") {
   // console.log("EDAD", calcularEdad(fechanac));
                if(calcularEdad(fechanac)<18){

                    msj.innerHTML='<div class="alert alert-danger">Debe agregar un pasajero mayor de edad, por favor verifique.</div>' ;
                    return false;
                }else{

                    if(tipodoc=="P"){

                        if( $('#nombres').val()=="" ||  $('#apellidos').val()==""){
                            //si no han llenado los nombres y apellidos
                            msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
                        }else{
                            //si llenaron los nombres y apellidos
                            let  pasajeroExiste=document.getElementById(cedula);
                            if(pasajeroExiste==null){
                                let nuevafechanac;
                                let date1 = new Date(fechanac);
                                let day1 = `0${date1.getDate()+1}`.slice(-2); //("0"+date.getDate()).slice(-2);
                                let month1 = `0${date1.getMonth() + 1}`.slice(-2);
                                let year1 = date1.getFullYear();
                                nuevafechanac=`${day1}-${month1}-${year1}`
                                console.log(`${day1}-${month1}-${year1}`);

                                var html="<tr id='"+cedula+"' data-menor='NO'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+nuevafechanac+"</td> <td>NO</td> <td class='text-center'> N/A </td> <td> <a href='#' onclick='openModalPassengers("+tipodoc+",'"+cedula+"', 2)' ><i class='fa fa-user' title='Agregar menor representado'></i></a> &nbsp;&nbsp; <a href='#' onclick='openModalPassengers("+tipodoc+",'"+cedula+"', 1)' ><i class='fa fa-trash' title='Eliminar'></i></a> </td>  </tr>";

                                subirDocumentos('NO', tipodoc, cedula, nuevafechanac, sexo, $('#nombres').val(), $('#apellidos').val(), html, '');
                                msj.innerHTML="";
                            }else{
                                msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                            }
                        }
                    }else{

                        //si es venezolano mayor de edad
                            $.ajax({
                                url: route('consultasaime2'),
                                data: {cedula: cedula, fecha:fechanac, sexo:sexo }

                            })// This will be called on success
                            .done(function (response) {

                                var respuesta = JSON.parse(response);
                                let tamano = respuesta.length;
                                if (tamano == 0) {
                                    console.log(respuesta);
                                } else {
                                    respuesta=respuesta[0];
                                    let sex='';
                                    respuesta.sexo=='F'? sex="Femenino":sex="Masculino";
                                    sexo=respuesta.sexo;
                                let  pasajeroExiste=document.getElementById('pass'+respuesta.cedula);

                                    if(pasajeroExiste==null){
                                        let nombres, apellidos;
                                        if (respuesta.nombre2==null) {nombres=respuesta.nombre1; }else{ nombres=respuesta.nombre1+" "+respuesta.nombre2;}
                                        if (respuesta.apellido2==null){apellidos=respuesta.apellido1; }else {apellidos=respuesta.apellido1+" "+respuesta.apellido2;}
                                        $('#nombres').val(nombres);
                                        $('#apellidos').val(apellidos);

                                        let nuevafechanac;
                                        let date1 = new Date(fechanac);
                                        let day1 = `0${date1.getDate()+1}`.slice(-2); //("0"+date.getDate()).slice(-2);
                                        let month1 = `0${date1.getMonth() + 1}`.slice(-2);
                                        let year1 = date1.getFullYear();
                                        nuevafechanac=`${day1}-${month1}-${year1}`
                                        console.log(`${day1}-${month1}-${year1}`);
                                            var html="<tr id='"+respuesta.cedula+"' data-menor='NO'> <td>"+tipodoc+"-"+respuesta.cedula+"</td> <td>"+nombres+"</td> <td>"+apellidos+"</td> <td>"+sex+"</td>  <td>"+nuevafechanac+"</td> <td>NO</td> <td class='text-center'> N/A </td><td><a href='#' onclick='openModalPassengers("+tipodoc+",'"+respuesta.cedula+"', 2)' ><i class='fa fa-user' title='Agregar menor representado'></i></a> &nbsp;&nbsp; <a href='#' onclick='openModalPassengers("+tipodoc+",'"+respuesta.cedula+"', 1)' ><i class='fa fa-trash' title='Eliminar'></i></a></td> </tr>";

                                        //pass.innerHTML+=html;

                                        subirDocumentos("NO", tipodoc, cedula, nuevafechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html,'');
                                        msj.innerHTML="";
                                    }else{
                                        msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                                    }


                                }
                                //alert(response);
                            })
                            .fail(function (response) {
                                msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

                            });

                    }
                }

            }else{
                msj.innerHTML='<div class="alert alert-danger">Existen campos vacios en el formulario, por favor verifique...</div>' ;
            }

     }

     function AddPassengerMenor(tipozarpe){

        let cedula= document.getElementById('numero_identificacionMenor').value;
        let fechanac= document.getElementById('fecha_nacimientoMenor').value;
         let nuevafechanac;
         let date1 = new Date(fechanac);
         let day1 = `0${date1.getDate()+1}`.slice(-2); //("0"+date.getDate()).slice(-2);
         let month1 = `0${date1.getMonth() + 1}`.slice(-2);
         let year1 = date1.getFullYear();
         nuevafechanac=`${day1}-${month1}-${year1}`
         console.log(`${day1}-${month1}-${year1}`);
        let sexo= document.getElementById('sexoMenor').value;
        let tipodoc= document.getElementById('tipodocmenor').value;
        let representante=document.getElementById('representanteMenor').value;
        var msj= document.getElementById('errorModalPass');
        var msjMayor= document.getElementById('msj');
        let partidaNacimiento=document.getElementById('partida_nacimiento').value;
        let autorizacion=document.getElementById('autorizacion').value;
        let pasaporteMenor=document.getElementById('pasaporte_menor').value;
        msjMayor.innerHTML="";
        if(tipozarpe=='ZI'){

            console.log('ZI pasaporye');
            if(pasaporteMenor==''){
                msj.innerHTML='<div class="alert alert-danger">El documento Pasaporte es requerido para el menor</div>' ;
                return false;

            }
            if(partidaNacimiento==''){
                msj.innerHTML='<div class="alert alert-danger">El documento Partida de Nacimiento es requerido para el menor</div>' ;
                return false;

            }


        }else if(tipozarpe=='ZN'){
            if(pasaporteMenor=='' && tipodoc=="P"){
                msj.innerHTML='<div class="alert alert-danger">El documento Pasaporte es requerido para el menor</div>' ;
                return false;

            }
            if(partidaNacimiento==''){
                msj.innerHTML='<div class="alert alert-danger">El documento Partida de Nacimiento es requerido para el menor</div>' ;
                return false;

            }
        }

        if(calcularEdad(fechanac)>=18){

            msj.innerHTML='<div class="alert alert-danger">Debe agregar un pasajero menor de edad en este formulario, por favor verifique.</div>' ;
            return false;
        }

        if (cedula!="" && fechanac!="" && sexo!="" && tipodoc!="" &&  partidaNacimiento!="") {

            if(tipodoc=="P"){
                //menor extranjero
                if( $('#nombresMenor').val()=="" ||  $('#apellidosMenor').val()==""){
                    //si no han llenado los nombres y apellidos
                    msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
                }else{
                    //si llenaron los nombres y apellidos
                    let  pasajeroExiste=document.getElementById(cedula);
                    if(pasajeroExiste==null){
                        //var html="<tr id='"+cedula+"' data-menor='SI'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombresMenor').val()+"</td> <td>"+$('#apellidosMenor').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>SI</td> <td class='text-center'> N/A </td> <td>  <a href='#' onclick='openModalPassengers("+tipodoc+","+cedula+", 1)' ><i class='fa fa-trash' title='Eliminar'></i></a> </td>  </tr>";

                        subirDocumentos('SI', tipodoc, cedula, nuevafechanac, sexo, $('#nombresMenor').val(), $('#apellidosMenor').val(), '', representante);

                        msj.innerHTML="";
                        $('#numero_identificacionMenor').val("");
                                $('#fecha_nacimientoMenor').val("");
                                $('#sexoMenor').val("");
                                $('#tipodocmenor').val("");
                                $('#nombresMenor').val("");
                                $('#apellidosMenor').val("");
                                $('#representanteMenor').val("");
                                $('#partida_nacimiento').val("");
                                $('#autorizacion').val("");
                                $('#pasaporte_menor').val("");
                                $('#pasaporte_mayor').val("");
                        closeModalPassengers(2);

                }else{
                        msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                    }


                }
            }else{
                //menor venezolano



                    if(tipodoc=="NC"){
                        if( $('#nombresMenor').val()=="" ||  $('#apellidosMenor').val()==""){
                            //si no han llenado los nombres y apellidos
                            msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
                        }else{
                         subirDocumentos('SI', tipodoc, cedula, nuevafechanac, sexo, $('#nombresMenor').val(), $('#apellidosMenor').val(), '', representante);
                        msj.innerHTML="";
                        $('#numero_identificacionMenor').val("");
                                $('#fecha_nacimientoMenor').val("");
                                $('#sexoMenor').val("");
                                $('#tipodocmenor').val("");
                                $('#nombresMenor').val("");
                                $('#apellidosMenor').val("");
                                $('#representanteMenor').val("");
                                $('#partida_nacimiento').val("");
                                $('#autorizacion').val("");
                                $('#pasaporte_menor').val("");
                                $('#pasaporte_mayor').val("");
                                $("#sexoMenor > option[value='']").removeAttr("selected");
                                $("#sexoMenor > option[value='F']").removeAttr("selected");
                                $("#sexoMenor > option[value='M']").removeAttr("selected");
                                 closeModalPassengers(2);

                         }
                    }else{

                        $.ajax({
                        url: route('consultasaime2'),
                        data: {cedula: cedula, fecha:fechanac, sexo:sexo }

                    })// This will be called on success
                    .done(function (response) {

                        var respuesta = JSON.parse(response);
                        let tamano = respuesta.length;
                        if (tamano == 0) {
                            console.log(respuesta);
                        } else {
                            respuesta=respuesta[0];
                            let sex='';
                            respuesta.sexo=='F'? sex="Femenino":sex="Masculino";
                           let  pasajeroExiste=document.getElementById(respuesta.cedula);
console.log(respuesta);
                            if(pasajeroExiste==null){
                                let nombres, apellidos;
                                if (respuesta.nombre2==null) {nombres=respuesta.nombre1; }else{ nombres=respuesta.nombre1+" "+respuesta.nombre2;}
                                if (respuesta.apellido2==null){apellidos=respuesta.apellido1; }else {apellidos=respuesta.apellido1+" "+respuesta.apellido2;}
                                $('#nombresMenor').val(nombres);
                                $('#apellidosMenor').val(apellidos);
                               // $('#sexoMenor').val(apellidos);


                                subirDocumentos("SI", tipodoc, cedula, nuevafechanac, sexo, $('#nombresMenor').val(), $('#apellidosMenor').val(),'',representante);
                                msj.innerHTML="";

                                $('#numero_identificacionMenor').val("");
                                $('#fecha_nacimientoMenor').val("");
                                $('#sexoMenor').val("");
                                $('#tipodocmenor').val("");
                                $('#nombresMenor').val("");
                                $('#apellidosMenor').val("");
                                $('#representanteMenor').val("");
                                $('#autorizacion').val("");
                                $('#pasaporte_menor').val("");
                                $('#partida_nacimiento').val("");
                                $("#sexoMenor > option[value='']").removeAttr("selected");
                                $("#sexoMenor > option[value='F']").removeAttr("selected");
                                $("#sexoMenor > option[value='M']").removeAttr("selected");
                                 closeModalPassengers(2);

                            }else{
                                msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                            }


                        }
                        //alert(response);
                    })
                    .fail(function (response) {
                        msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

                    });


                    }



            }



        }else{
              msj.innerHTML='<div class="alert alert-danger">Existen campos vacios en el formulario, por favor verifique...</div>' ;
        }

     }

function blurSaime(){

    let cedula= document.getElementById('numero_identificacionMenor').value;
    let fechanac= document.getElementById('fecha_nacimientoMenor').value;
    var msj= document.getElementById('errorModalPass');
    let sexo= document.getElementById('sexoMenor').value;
        let tipodoc= document.getElementById('tipodocmenor').value;

    const asset=msj.getAttribute('data-asset');
    msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif' width='30px'> &nbsp; Comparando datos con registros existentes en SAIME, por favor espere...</div>";
    if(cedula!='' && fechanac!='' && tipodoc=='V'){
        $.ajax({
            url: route('consultasaime2'),
            data: {cedula: cedula, fecha:fechanac, sexo:sexo }
        })// This will be called on success
        .done(function (response) {
                var respuesta = JSON.parse(response);
                let tamano = respuesta.length;
                let  pasajeroExiste=document.getElementById(respuesta.cedula);

                if(pasajeroExiste==null){
                    let nombres, apellidos;
                    if (respuesta[0].nombre2==null) {nombres=respuesta[0].nombre1; }else{ nombres=respuesta[0].nombre1+" "+respuesta[0].nombre2;}
                    if (respuesta[0].apellido2==null){apellidos=respuesta[0].apellido1; }else {apellidos=respuesta[0].apellido1+" "+respuesta[0].apellido2;}
                    $('#nombresMenor').val(nombres);
                    $('#apellidosMenor').val(apellidos);
                    $("#sexoMenor > option[value='']").removeAttr("selected");
                    $("#sexoMenor > option[value='F']").removeAttr("selected");
                    $("#sexoMenor > option[value='M']").removeAttr("selected");

                    $("#sexoMenor > option[value="+respuesta[0].sexo+"]").attr("selected",true);

                    msj.innerHTML="";
                }else{
                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                }

                        //alert(response);
        })
        .fail(function (response) {
            msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

        });
    }else{
        msj.innerHTML='';
    }

}






 function getData() {
    let cedula= document.getElementById('numero_identificacion').value;
    let fechanac= document.getElementById('fecha_nacimiento').value;
    let sexo= document.getElementById('sexo').value;
    let tipodoc= document.getElementById('tipodoc').value;
    let menor= document.getElementById('menor').value;
    let men='';
    var msj= document.getElementById('msj');
    var pass=document.getElementById('pasajeros');
    const asset=msj.getAttribute('data-asset');

    msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif' width='30px'> &nbsp; Comparando datos con registros existentes en SAIME, por favor espere...</div>";

    var div=document.getElementById("dataPassengers");
    cantAct=parseInt(div.getAttribute("data-cant"));

    if(cantAct==0){
        pass.innerHTML="";
    }

    if ($("#menor").is(':checked')) {men="SI";}else{men="NO";}

    if (cedula!="" && fechanac!="" && sexo!="" && tipodoc!="") {

        if(tipodoc=="P"){

            if( $('#nombres').val()=="" ||  $('#apellidos').val()==""){
                //si no han llenado los nombres y apellidos
                msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
            }else{
                //si llenaron los nombres y apellidos
                let  pasajeroExiste=document.getElementById('pass'+cedula);
                if(pasajeroExiste==null){
                    //var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                    addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(), html);
                    msj.innerHTML="";
                }else{
                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                }
            }
        }else{

            if( tipodoc=="NC" && ($('#nombres').val()=="" ||  $('#apellidos').val()=="") ){

                msj.innerHTML='<div class="alert alert-danger">Los campos nombres y apellidos son requeridos</div>' ;
            }else{
                if ($('#menor').prop('checked')) {
                    //si es venezolano menor de edad
                    if(tipodoc=="NC"){ //si es no cedulado
                        let  pasajeroExiste=document.getElementById('pass'+cedula);
                        if(pasajeroExiste==null){
                      //      var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                            msj.innerHTML="";
                            addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html);
                            document.querySelector("#nc").remove();
                        }else{
                            msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                        }

                    }else{//si es menor con cedula
                        $.ajax({
                            url: route('consultasaime2'),
                            data: {cedula: cedula, fecha:fechanac, sexo:sexo }

                        })// This will be called on success
                        .done(function (response) {

                            var respuesta = JSON.parse(response);
                            let tamano = respuesta.length;
                            if (tamano == 0) {
                                console.log(respuesta);
                            } else {
                                respuesta=respuesta[0];
                                let sex='';
                                respuesta.sexo=='F'? sex="Femenino":sex="Masculino";
                               let  pasajeroExiste=document.getElementById('pass'+respuesta.cedula);

                                if(pasajeroExiste==null){
                                    let nombres, apellidos;
                                    if (respuesta.nombre2==null) {nombres=respuesta.nombre1; }else{ nombres=respuesta.nombre1+" "+respuesta.nombre2;}
                                    if (respuesta.apellido2==null){apellidos=respuesta.apellido1; }else {apellidos=respuesta.apellido1+" "+respuesta.apellido2;}
                                    $('#nombres').val(nombres);
                                    $('#apellidos').val(apellidos);

                                    $('#sexoMenor').val(respuesta.sexo);

                        //            var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                                    addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html);
                                    //pass.innerHTML+=html;

                                    msj.innerHTML="";
                                }else{
                                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                                }


                            }
                            //alert(response);
                        })
                        .fail(function (response) {
                            msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

                        });

                    }
                }else{

                    //si es venezolano mayor de edad
                    $.ajax({
                        url: route('consultasaime2'),
                        data: {cedula: cedula, fecha:fechanac, sexo:sexo }

                    })// This will be called on success
                    .done(function (response) {

                        var respuesta = JSON.parse(response);
                        let tamano = respuesta.length;
                        if (tamano == 0) {
                            console.log(respuesta);
                        } else {
                            respuesta=respuesta[0];
                            let sex='';
                            respuesta.sexo=='F'? sex="Femenino":sex="Masculino";
                           let  pasajeroExiste=document.getElementById('pass'+respuesta.cedula);

                            if(pasajeroExiste==null){
                                let nombres, apellidos;
                                if (respuesta.nombre2==null) {nombres=respuesta.nombre1; }else{ nombres=respuesta.nombre1+" "+respuesta.nombre2;}
                                if (respuesta.apellido2==null){apellidos=respuesta.apellido1; }else {apellidos=respuesta.apellido1+" "+respuesta.apellido2;}
                                $('#nombres').val(nombres);
                                $('#apellidos').val(apellidos);


                                    var html="<tr id='pass"+respuesta.cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+respuesta.cedula+"</td> <td>"+nombres+"</td> <td>"+apellidos+"</td> <td>"+sex+"</td>  <td>"+respuesta.fecha_nacimiento+"</td> <td>"+men+"</td> </tr>";

                                pass.innerHTML+=html;
                                addPassengers(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val());
                                msj.innerHTML="";
                            }else{
                                msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;

                            }


                        }
                        //alert(response);
                    })
                    .fail(function (response) {
                        msj.innerHTML='<div class="alert alert-danger">No se encontraron coincidencias con los datos suministrados.</div>' ;

                    });


                }
            }

        }



    }else{

        msj.innerHTML='<div class="alert alert-danger">Existen campos vacios en el formulario, por favor verifique...</div>' ;
    }



}




$('#menor').click(function() {
    let option= document.createElement("option");

    if($("#menor").is(':checked')){
        $("#textoMenor").text('SI');  // checked
        $('.DatosRestantes').attr('style', 'display:block');

        let select=document.querySelector("#tipodoc");
        let existe = !!document.getElementById("nc");
        if(!existe){
            option.id="nc";
            option.value="NC";
            option.textContent="No cedulado";
            select.appendChild(option);
        }


        str =$( "select option:selected" ).val();
        let date = new Date();
        let fechamin="";
        if( str=="NC"){
            $('#apellidos').val("");
            $('#nombres').val("");
            fechamin=date.getFullYear()-10;
            fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
            fechamin+="-"+String(date.getDate()).padStart(2, '0');
        }else{
            fechamin=date.getFullYear()-18;
            fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
            fechamin+="-"+String(date.getDate()).padStart(2, '0');
        }

        let fmax=date.getFullYear()+"-"+(String(date.getMonth() + 1).padStart(2, '0'))+"-"+String(date.getDate()).padStart(2, '0');

        $('#fecha_nacimiento').attr('min',fechamin );
        $('#fecha_nacimiento').attr('max',fmax );


    }
    else{
        $("#textoMenor").text('NO');
        $('.DatosRestantes').attr('style', 'display:none');
        document.querySelector("#nc").remove();
        let date = new Date();
        let fechamax="";
        fechamax=date.getFullYear()-18;
        fechamax+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
        fechamax+="-"+String(date.getDate()).padStart(2, '0');
        $('#fecha_nacimiento').attr('max',fechamax );
        $('#fecha_nacimiento').attr('min',"" );


    }


});








$( "#tipodoc" )
  .change(function () {
    var str = "";
    str =$( "select option:selected" ).val();
    $( "#numero_identificacion" ).val('');
    if(str=="P"){
      $('.DatosRestantes').attr('style', 'display:block');
      $( "#numero_identificacion" ).attr('onKeyDown','');
    }else{
        let date = new Date();
        let fechamin="";

        if((str=="V" || str=="NC") && $('#menor').prop('checked')){
            $( "#numero_identificacion" ).attr('onKeyDown','return soloNumeros(event)');
            $('.DatosRestantes').attr('style', 'display:block');
            if( str=="NC"){
                fechamin=date.getFullYear()-10;
                fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
                fechamin+="-"+String(date.getDate()).padStart(2, '0');
            }else{
                fechamin=date.getFullYear()-18;
                fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
                fechamin+="-"+String(date.getDate()).padStart(2, '0');
            }

            $('#fecha_nacimiento').attr('min',fechamin );
            let fmax=date.getFullYear()+"-"+(String(date.getMonth() + 1).padStart(2, '0'))+"-"+String(date.getDate()).padStart(2, '0');
            $('#fecha_nacimiento').attr('max',fmax );
        }else{
            $('.DatosRestantes').attr('style', 'display:none');
            $('#fecha_nacimiento').attr('min',"" );
            $( "#numero_identificacion" ).attr('onKeyDown','return soloNumeros(event)');
            let date = new Date();
            let fechamax="";
            fechamax=date.getFullYear()-18;
            fechamax+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
            fechamax+="-"+String(date.getDate()).padStart(2, '0');
            $('#fecha_nacimiento').attr('max',fechamax );


        }
    }

  })
  .change();

function subirDocumentos(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html, representante){

    if(menor=='SI'){
       let partidaNacimiento=document.getElementById('partida_nacimiento').files[0];
        let autorizacion=document.getElementById('autorizacion').files[0];
        let pasaporte=document.getElementById('pasaporte_menor').files[0];

        var formData = new FormData();
        formData.append('partida_nacimiento', partidaNacimiento);
        formData.append('autorizacion', autorizacion);
        formData.append('pasaporte_menor', pasaporte);

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: route('AddDocumentos'),
            type: "POST",
            dataType: "html",
            data:formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (response){
            var resps=JSON.parse(response);
            if(resps[0] =='OK'){
                partida=resps[1];
                auth=resps[2];
                pasaporte_menor=resps[3];

                console.log("MENOR:",resps);
                console.log("pasaporte_menor",pasaporte_menor);
                addPassengers2(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html, representante, resps);


            }

        });
    }else{
        let pasaportemayor=document.getElementById('pasaporte_mayor').files[0];

        var formData = new FormData();
        formData.append('pasaporte_mayor', pasaportemayor);
        console.log(formData);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: route('AddDocumentos'),
            type: "POST",
            dataType: "html",
            data:formData,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (response){
            var resps=JSON.parse(response);
            if(resps[0] =='OK'){
                partida=resps[1];
                auth=resps[2];
                //pasaporte_menor=resps[3];
                pasaporte_mayor=resps[4];
                console.log("MAYOR:",resps);
                addPassengers2(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html, representante, resps);

            }

        });
    }

}



function addPassengers2(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html, representante,documentos){
    let msj=document.getElementById('msj');
    var partida=documentos[1];
    var auth=documentos[2];
    var pasaporte_menor=documentos[3];
    var pasaporte_mayor=documentos[4];

console.log("Documentos::",documentos);

     $.ajax({
        url: route('AddPassenger'),
        data: {
            menor: menor,
            tipodoc:tipodoc,
            nrodoc:nrodoc,
            fechanac: fechanac,
            sexo:sexo,
            nombres: nombres,
            apellidos: apellidos,
            representante: representante,
            partida_nacimiento:partida,
            autorizacion:auth,
            pasaporte_mayor:pasaporte_mayor,
            pasaporte_menor:pasaporte_menor
        }
    })// This will be called on success
        .done(function (response) {
             var resp=JSON.parse(response);
             console.log('RESPUESTAPAss',resp);

             switch(resp[0]){
                case 'ExistInPassengerList':
                    msj.innerHTML='<div class="alert alert-danger">El pasajero ya se encuentra asignado a la lista, por favor verifique</div>' ;
                break;
                case 'MaxPassengerLimit':
                    msj.innerHTML='<div class="alert alert-danger">Ha alcanzado el máximo de pasageros disponibles para esta embarcación</div>' ;
                break;
                case 'PassengerAsigned':
                    msj.innerHTML='<div class="alert alert-danger">El pasajero con C.I. / Pasaporte '+nrodoc+' se encuentra asignado a una embarcación con un permiso de zarpe pendiente o en curso actualmente</div>' ;
                break;
                case 'OK':
                    if(representante==''){
                        representante='N/A';
                    }
                    let respuesta=resp[1];
                    let modal="<a href='#' onclick=\"openModalPassengers('"+tipodoc+"','"+respuesta.nro_doc+"', 2)\" ><i class='fa fa-user' title='Agregar menor representado'></i></a> &nbsp;&nbsp; ";
                    if(menor=='SI'){
                        modal='';
                    }

                    var html="<tr id='"+respuesta.nro_doc+"' data-menor='"+menor+"'> <td>"+tipodoc+"-"+respuesta.nro_doc+"</td> <td>"+nombres+"</td> <td>"+apellidos+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+menor+"</td> <td class='text-center'> "+representante+"</td> <td> "+modal+" <a href='#' onclick=\"openModalPassengers('"+tipodoc+"','"+respuesta.nro_doc+"', 1)\" ><i class='fa fa-trash' title='Eliminar'></i></a> </td>  </tr>";

                    addPassengers(menor, tipodoc, respuesta.nro_doc, fechanac, sexo, nombres, apellidos, html)
                break;
             }

            // msj.innerHTML=response;
        })
        // This will be called on error
        .fail(function (response) {

        });
}

function deletePassenger(){
    let btn=document.getElementById('btnDelete');
    var cedula=btn.getAttribute('data-ced');
    let msj=document.getElementById('msj');
    $.ajax({
        url: route('deletePassenger'),
        data: {index: cedula }
    })// This will be called on success
        .done(function (response) {

            console.log("DeletePass:",response);
            if(response[0]==true){
                response[1].forEach(element => {
                    let tr=document.getElementById(element);
                    tr.remove();
                    var cantPass= document.getElementById("cantPasajeros");
                    let cant=parseInt(cantPass.getAttribute("data-cantPass"));
                    cantPass.innerHTML=response[2];
                });


                msj.innerHTML='<div class="alert alert-success">Pasajero eliminado con éxito.</div>' ;

            }else{
                msj.innerHTML='<div class="alert alert-danger">No se ha podido eliminar el pasajero del listado, actualice la ventana del navegador e intente nuevamente.</div>' ;
            }
            closeModalPassengers(1);
        })
        // This will be called on error
        .fail(function (response) {

        });
}


function addPassengers(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html){
    console.log(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos);
    console.log("incio", html, "aqui");
    var cantPass= document.getElementById("cantPasajeros");
    let cant=parseInt(cantPass.getAttribute("data-cantPass"));

    if(cant > 0){

        cant=cant-1;
        cantPass.innerHTML=cant;
        cantPass.setAttribute("data-cantPass", cant);


        var pass=document.getElementById('pasajeros');
        //if(tipodoc!='V'){
            pass.innerHTML+=html;
        //}

        var div=document.getElementById("dataPassengers");
        cantAct=parseInt(div.getAttribute("data-cant"));
        let contenedor= document.createElement("div");
        contenedor.id="content"+cantAct;


        let inputMenor= document.createElement("input");
        let inputTipodoc= document.createElement("input");
        let inputNrodocc= document.createElement("input");
        let inputFechanac= document.createElement("input");
        let inputSexo= document.createElement("input");
        let inputNombres= document.createElement("input");
        let inputApellidos= document.createElement("input");

         inputMenor.type="hidden";
         inputTipodoc.type="hidden";
         inputNrodocc.type="hidden";
         inputFechanac.type="hidden";
         inputSexo.type="hidden";
         inputNombres.type="hidden";
         inputApellidos.type="hidden";

         inputMenor.name="menor[]";
         inputTipodoc.name="tipodoc[]";
         inputNrodocc.name="nrodoc[]";
         inputFechanac.name="fechanac[]";
         inputSexo.name="sexo[]";
         inputNombres.name="nombres[]";
         inputApellidos.name="apellidos[]";

         inputMenor.value=menor;
         inputTipodoc.value=tipodoc;
         inputNrodocc.value=nrodoc;
         inputFechanac.value=fechanac;
         inputSexo.value=sexo;
         inputNombres.value=nombres;
         inputApellidos.value=apellidos;

         contenedor.appendChild(inputMenor);
         contenedor.appendChild(inputTipodoc);
         contenedor.appendChild(inputNrodocc);
         contenedor.appendChild(inputFechanac);
         contenedor.appendChild(inputSexo);
         contenedor.appendChild(inputNombres);
         contenedor.appendChild(inputApellidos);



         div.appendChild(contenedor);

         div.setAttribute("data-cant",cantAct+1);
        console.log(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos);
        $("#menor").prop('checked', false);
        $("#textoMenor").text('NO');
        document.getElementById("numero_identificacion").value="";
        document.getElementById("tipodoc").options.item(0).selected = 'selected';
        document.getElementById("fecha_nacimiento").value="";
        document.getElementById("sexo").options.item(0).selected = 'selected';
        document.getElementById("nombres").value="";
        document.getElementById("apellidos").value="";
        document.getElementById("pasaporte_mayor").value="";
        if(menor=='SI'){
            location.reload(true);
        }

    }else{
        var msj= document.getElementById('msj');
        msj.innerHTML='<div class="alert alert-danger">Ha alcanzado la cantidad máxima de pasajeros para esta embarcación.</div>' ;
    }

}



/* inicio de validacion paso cinco marinos*/
function validacionMarino(){
    let cedula= document.getElementById('cedula').value;
    let funcion= document.getElementById('funcion').value;
    let msj=document.getElementById('msjMarino');
    let tabla=document.getElementById('marinos');
    let flashMsj=document.getElementById('flashMsj');
    if(flashMsj != null){
        flashMsj.setAttribute('class','');
        flashMsj.innerHTML="";
    }

    let ErrorsFlash=document.getElementById('ErrorsFlash');
    if(ErrorsFlash != null){
        ErrorsFlash.setAttribute('class','');
        ErrorsFlash.innerHTML="";
    }

    if(cedula=="" || funcion==""){
        msj.innerHTML='<div class="alert alert-danger">Existen campos vacios en el formulario, por favor verifique.</div>' ;

    }else{
        $.ajax({
            url: route('validacionMarino'),
            data: {cedula: cedula, funcion:funcion  }
        }).done(function (response) {
            resp = JSON.parse(response);
            respuesta=resp[0];
            validacion=resp[1];
            existe=resp[2];

            console.log("RespuestaMarinos:",resp);
            if(existe==true){
                 msj.innerHTML='<div class="alert alert-danger">El tripulante ya se encuentra asignado a la lista, por favor verifique</div>' ;
            }else{


                     switch(resp[3]){
                        case 'saimeNotFound':
                            msj.innerHTML='<div class="alert alert-danger">No se han encontrado coincidencias con los datos suministrados, por favor verifique</div>' ;

                        break;
                        case 'gmarNotFound':
                            msj.innerHTML='<div class="alert alert-danger">La cédula suministrada no pertenece a ningún marino, por favor verifique</div>' ;

                        break;
                        case 'FoundButDefeated':
                            msj.innerHTML='<div class="alert alert-danger">La vigencia de la licencia del tripulante C.I. '+cedula+' se encuentra vencida, por este motivo no puede tripular ninguna embarcación por el momento.</div>' ;
                        break;
                        case 'FoundButAssigned':
                            msj.innerHTML='<div class="alert alert-danger">El tripulante C.I./Pasaporte '+cedula+' se encuentra asignado a una embarcación que tiene un zarpe programado o en curso actualmente</div>' ;
                        break;
                        case 'FoundButMaxTripulationLimit':
                            msj.innerHTML='<div class="alert alert-danger">Ha alcanzado el máximo de personas abordo para la embarcación, no es posible agregar mas tripulantes o pasajeros.</div>' ;

                        break;
                        case 'capitanExiste':
                            msj.innerHTML='<div class="alert alert-danger">Sólo un tripulante puede ejercer como capitán de la embarcación, por favor verifique.</div>' ;

                        break;

                        default:

                            if(validacion[0] ==true){ //verifico si está autorizado para navegar en la envarcación
                                console.log('RESPUESTA',respuesta);



                                let cantidad=respuesta.length;
                                let fecha=respuesta[cantidad-1].fecha_vencimiento.substr(0, 10);
                                let fecha2= fecha.split('-');
                                fecha=fecha2[2]+"-"+fecha2[1]+"-"+fecha2[0];
                                let fechaemision=respuesta[cantidad-1].fecha_emision.substr(0, 10);
                                let fechaemision2= fechaemision.split('-');
                                fechaemision=fechaemision2[2]+"-"+fechaemision2[1]+"-"+fechaemision2[0];
                                msj.innerHTML="";


                                $('#example1').DataTable({
                                    responsive: true,
                                    autoWidth: true,
                                    language: {
                                        "url": "../assets/DataTables/es_es.json"
                                    },
                                    "destroy": true,
                                    "createdRow": function( row, data, dataIndex ) {

                                        $(row).attr('id','trip'+data.cedula );
                                    },
                                    "data": respuesta,

                                    "columns":[
                                        {"data":'funcion', 'title': 'Función'},
                                        {"data":'cedula'},
                                        {"data":'nombre'},
                                        {"data":'fecha_emision',
                                            render: function ( data, type, row ) {
                                           // esto es lo que se va a renderizar como html
                                                let fm="N/A";
                                                if(row.fecha_emision!=''){
                                                    fm=row.fecha_emision;
                                                }
                                                return `${fm}`;
                                            }
                                        },
                                        {"data":'solicitud'},
                                        {"data":'documento'},
                                        {
                                            "data":"cedula",
                                                render: function ( data, type, row ) {
                                                    // esto es lo que se va a renderizar como html

                                                    return `<a href='#' onclick=\"openModal('${row.cedula}')\"><i class='fa fa-trash text-center' title='Eliminar'></i></a>`;
                                                }
                                        },
                                    ],

                                });

                                document.getElementById('cedula').value="";


                                msj.innerHTML="";
                            }else{

                                    if(funcion=="Capitán"){
                                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+cedula+' no esta permisado para ser capitán esta embarcación.</div>' ;
                                    }else{
                                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+cedula+' no esta permisado para tripular esta embarcación.</div>' ;

                                    }
                            }

                        break;
                    }
            }

        }).fail(function (response) {

            console.log(response);
        });
    }
}

/*
function getMarinos() {
    let cedula= document.getElementById('cedula').value;
   // let fechanac= document.getElementById('fecha_nacimiento').value;
    let msj=document.getElementById('msjMarino');
    msj.innerHTML="";
    const asset=msj.getAttribute('data-asset');
    msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif'   width='35px'> &nbsp; Comparando datos con registros existentes en gente de mar, por favor espere...</div>";
    let flashMsj=document.getElementById('flashMsj');
    if(flashMsj != null){
        flashMsj.setAttribute('class','');
        flashMsj.innerHTML="";
    }

    let ErrorsFlash=document.getElementById('ErrorsFlash');
    if(ErrorsFlash != null){
        ErrorsFlash.setAttribute('class','');
        ErrorsFlash.innerHTML="";
    }
    let tabla=document.getElementById('marinos');
    let divMarinos=document.getElementById('dataMarinos');
    let cantMax=divMarinos.getAttribute('data-cantmaxima');
    let cantMin=divMarinos.getAttribute('data-cantMinima');

    let cantMar=divMarinos.getAttribute('data-cantMar');
    let cap="";
    if($("#cap").is(':checked')){
        cap="SI";
    }else{
        cap="NO";
    }


        if(parseInt(cantMar) >= parseInt(cantMax)){
            msj.innerHTML='<div class="alert alert-danger">Ha alcanzado la capacidad máxima de la embarcación.</div>' ;

        }else if(cantMar < cantMin){
            msj.innerHTML='<div class="alert alert-danger">No ha alcanzado la cantidad mínima de tripulantes para esta embarcación, por favor verifique.</div>' ;
        }else{

        if(cedula=="" ){

            msj.innerHTML='<div class="alert alert-danger">El campo cédula es requerido, por favor verifique</div>' ;

        }else{
        $.ajax({
            url: route('validarMarino'),
            data: {cedula: cedula, cap:cap }

        })// This will be called on success
            .done(function (response) {
                console.log(response);
                resp = JSON.parse(response);
                respuesta=resp[0];
                validacion=resp[1];
                let tamano = respuesta.length;
                console.log(validacion);


                if(typeof respuesta=='string'){
                     switch(respuesta){
                        case 'saimeNotFound':
                            msj.innerHTML='<div class="alert alert-danger">No se han encontrado coincidencias con los datos suministrados, por favor verifique</div>' ;

                        break;
                        case 'gmarNotFound':
                            msj.innerHTML='<div class="alert alert-danger">La cédula suministrada no pertenece a ningún marino, por favor verifique</div>' ;

                        break;
                        case 'FoundButDefeated':
                            msj.innerHTML='<div class="alert alert-danger">La vigencia de la licencia del tripulante C.I. '+cedula+' se encuentra vencida, por este motivo no puede tripular ninguna embarcación por el momento.</div>' ;
                        break;
                        case 'FoundButAssigned':
                            msj.innerHTML='<div class="alert alert-danger">El tripulante C.I. '+cedula+' se encuentra asignado a una embarcación que tiene un zarpe programado o en curso actualmente</div>' ;
                        break;

                        default:
                        console.log(respuesta);  msj.innerHTML="";
                        break;
                    }

                }else{
                    let  marinoExiste=document.getElementById('trip'+respuesta[0].ci);

                    if(marinoExiste==null){



                        let fecha=respuesta[0].fecha_vencimiento.substr(0, 10);
                        let fechaemision=respuesta[0].fecha_emision.substr(0, 10);
                        //let vt=validarTripulante(respuesta[0].documento, cap);
                        if(validacion[0]){
                            validarCapitan("");
                            console.log(respuesta);
                            msj.innerHTML="";
                            var html="<tr id='trip"+respuesta[0].ci+"'> <td>"+cap+"</td><td>"+respuesta[0].ci+"</td> <td>"+respuesta[0].nombre+" "+respuesta[0].apellido+"</td>   <td>"+fechaemision.substr(0, 10)+"</td> <td>"+respuesta[0].documento+"</td><td> </td> </tr>";
                            cantAct=parseInt(document.getElementById("dataMarinos").getAttribute("data-cantMar"));
                            if(cantAct==0){
                                tabla.innerHTML="";
                            }
                            tabla.innerHTML+=html;
                            document.getElementById('cedula').value="";
                           // document.getElementById('fecha_nacimiento').value="";
                            addMarino(respuesta[0].id, cap, respuesta[0].ci,respuesta[0].nombre+" "+respuesta[0].apellido, fecha, respuesta[0].documento, fechaemision);
                            msj.innerHTML="";
                        }else{


                            if($("#cap").is(':checked')){

                                msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+respuesta[0].ci+' no esta permisado para ser capitán esta embarcación.</div>' ;
                                validarCapitan('X');
                            }else{
                                msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+respuesta[0].ci+' no esta permisado para tripular esta embarcación.</div>' ;

                            }

                        }

                    }else{
                        msj.innerHTML='<div class="alert alert-danger">El tripulante ya se encuentra asignado a la lista, por favor verifique</div>' ;

                    }

                }
            })

            // This will be called on error
            .fail(function (response) {
                msj.innerHTML='<div class="alert alert-danger">No se ha encontrado la cedula o la fecha de nacimiento</div>' ;
                        console.log(response);

            });
    }


}

}*/


function AddPasportsMarinosZN(){
    let doc=document.getElementById('doc').files[0];
    let docAcreditacion=document.getElementById('documentoAcreditacion').files[0];
    console.log('documentoAcreditacion',documentoAcreditacion);
    let tipodoc=document.getElementById('tipodoc').value;
    console.log("tipoDOC", tipodoc);
    console.log("doc", doc);
    if(tipodoc==""){
        let msj=document.getElementById('msjMarino');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que seleccione el tipo de documento</div>";
                return false;
    }
     switch(tipodoc){
        case 'P':

            if (!doc){
                let msj=document.getElementById('msjMarino');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que adjunte el pasaporte.</div>";
                return false;
            }
            if (!docAcreditacion){
                let msj=document.getElementById('msjMarino');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que adjunte el documento de acreditación.</div>";
                return false;
            }

        break;
        case 'V':
           /** if (!doc){
                let msj=document.getElementById('msjMarino');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que adjunte el pasaporte.</div>";
                return false;
            }*/

        break;


     }

    var formData = new FormData();
    formData.append('doc', doc);
    formData.append('documentoAcreditacion', docAcreditacion);


    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: route('AddDocumentosMarinosZN'),
        type: "POST",
        dataType: "html",
        data:formData,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (response){
        var resps=JSON.parse(response);
        console.log('RESPDOCS',resps);
        var documentos;
        if(tipodoc=='P'){
            if(resps[0][0] =='OK' || resps[1][0] =='OK'){

                pasaporteName=resps;
                documentos=[resps[0][1],resps[1][1]];
                getMarinos(documentos);
            }else{
                let msj=document.getElementById('msjMarino');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Ha ocurrido un error al adjuntar los documentos, actualice el navegador e intente nuevamente. Asegúrese de que las extenciones de archivo sean .jpg, .png o .pdf.</div>";

            }
        }else{
            //if(resps[0][0] =='OK'){

                pasaporteName=resps;
                documentos=["",""];
                getMarinos(documentos);
            //}
        }



    });


}


function getMarinos(pass) {
    let funcion= document.getElementById('funcion').value;
    let tipodoc= document.getElementById('tipodoc').value;
    let nrodoc= document.getElementById('nrodoc').value;
    let nombres= document.getElementById('nombres').value;
    let apellidos= document.getElementById('apellidos').value;
    let rango= document.getElementById('rango').value;
    let sexo= document.getElementById('sexo').value;
    let fechanac= document.getElementById('fecha_nacimiento').value;
    let doc=pass[0];
    let docAcreditacion=pass[1];
    let ruta='';
    let tabla=document.getElementById('marinos');
    let msj=document.getElementById('msjMarino');
    msj.innerHTML="";
    let flashMsj=document.getElementById('flashMsj');
    if(flashMsj != null){
        flashMsj.setAttribute('class','');
        flashMsj.innerHTML="";
    }

    let ErrorsFlash=document.getElementById('ErrorsFlash');
    if(ErrorsFlash != null){
        ErrorsFlash.setAttribute('class','');
        ErrorsFlash.innerHTML="";
    }

    if(funcion=='' || tipodoc =='' || nrodoc =='' ){
        msj.innerHTML="<div class='alert alert-danger'>Existen campos vacios en el formulario, por favor verifique.</div>";
    }else if(tipodoc=='P' && (nombres == '' || apellidos == '' || sexo=='' || fechanac=="" || rango=="")){

        msj.innerHTML="<div class='alert alert-danger'>Existen campos vacios en el formulario, por favor verifique.</div>";

    }else{
         msj.innerHTML='';
        if(tipodoc=='V'){
            ruta=route('validacionMarino');
        }else{
            ruta=route('marinoExtranjero');
        }
        const asset=msj.getAttribute('data-asset');
        msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif' width='30px'> &nbsp; Comparando datos con registros existentes, por favor espere...</div>";
        $.ajax({
        url: ruta,
        data: {
            funcion:funcion,
            tipodoc:tipodoc,
            nrodoc:nrodoc,
            nombres:nombres,
            apellidos:apellidos,
            sexo:sexo,
            fecha_nacimiento:fechanac,
            doc:doc,
            docAcreditacion:docAcreditacion,
            rango:rango,

        }

        })// This will be called on success
        .done(function (response) {

            respuesta = JSON.parse(response);
                console.log("RESPUESTA::",respuesta);

            var validacion=respuesta[1];
            switch(respuesta[3]){
                case 'TripulanteExiste':
                    msj.innerHTML="<div class='alert alert-danger'>El tripulante que intenta agregar ya se encuentra en el listado, por favor verifique.</div>";

                break;
                case 'capitanExiste':
                    msj.innerHTML="<div class='alert alert-danger'>Sólo puede haber un capitán asignado a la embarcación, por favor verifique.</div>";

                break;
                case 'FoundButMaxTripulationLimit':
                    msj.innerHTML="<div class='alert alert-danger'>Ha alcanzado el máximo de tripulantes disponibles para la embarcación.</div>";

                break;
                case 'TripulanteNoAutorizado':
                        if(funcion=="Capitán"){
                                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+nrodoc+' no esta permisado para ser capitán esta embarcación.</div>' ;
                            }else{
                                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+nrodoc+' no esta permisado para tripular esta embarcación.</div>' ;

                        }
                break;
                case 'gmarNotFound':
                    msj.innerHTML="<div class='alert alert-danger'>La cédula suministrada no pertenece a un marino venezolano.</div>";

                break;
                case 'FoundButAssigned':
                            msj.innerHTML='<div class="alert alert-danger">El tripulante C.I. / Pasaporte '+nrodoc+' se encuentra asignado a una embarcación que tiene un zarpe programado o en curso actualmente</div>' ;
                break;
                case 'FoundInList':
                    msj.innerHTML='<div class="alert alert-danger">El tripulante con el número de documento '+nrodoc+' ya se encuentra en el listado, por favor verifique.</div>' ;
                break;
                case 'FoundButNotPerrmision':
                    if(funcion=="Capitán"){
                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+pass['nro_doc']+' no esta permisado para ser capitán esta embarcación.</div>' ;
                    }else{
                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+pass['nro_doc']+' no esta permisado para tripular esta embarcación.</div>' ;
                    }

                break;
                case 'OK':

                  //  let cantidad=respuesta1.length;

//console.log('validacion[0]',validacion[0]);
                     if(validacion[0] ==true){


                        var nodataTrip = !!document.getElementById("nodataTrip");

                        if(nodataTrip==true){
                            tabla.innerHTML='';
                        }
                        //let html="<tr id='"+pass['nro_doc']+"'><td> "+pass['funcion']+"</td><td>"+pass['tipo_doc']+"-"+pass['nro_doc']+"</td> <td>"+pass['nombres']+" "+pass['apellidos']+"</td> <td>"+pass['rango']+"</td> <td>"+pass['doc']+"</td><td>  <a href='#' onclick=\"openModalZI('"+pass['nro_doc']+"')\"><i class='fa fa-trash'></i></a></td></tr>";
                       // tabla.innerHTML+=html;
                         pass1=respuesta[0];
                         console.log("PASS1",pass1);
                         pass1=pass1[pass1.length-1];
                         let ruta=tabla.getAttribute('data-rimg');
                         $('#example2').DataTable({
                             responsive: true,
                             autoWidth: true,
                             language: {
                                 "url": "../assets/DataTables/es_es.json"
                             },
                             "destroy": true,
                             "createdRow": function( row, data, dataIndex ) {
                                 $(row).attr('id',data.nro_doc );
                             },
                             "data": respuesta[0],
                             "columns":[
                                 {"data":'funcion'},
                                 {
                                    "data":"tipo_doc",
                                    render: function ( data, type, row ) {
                                        // esto es lo que se va a renderizar como html
                                        return `${row.tipo_doc} ${row.nro_doc}`;
                                    }
                                 },
                                  {
                                    "data":"nombres",
                                    render: function ( data, type, row ) {
                                        // esto es lo que se va a renderizar como html
                                        return `${row.nombres}  ${row.apellidos}`;
                                    }
                                 },
                                 {"data":'fecha_nacimiento'},

                                 {"data":'sexo'},
                                 {"data":'fecha_emision'},
                                 {"data":'nro_ctrl',
                                     render: function ( data, type, row ) {
                                         // esto es lo que se va a renderizar como html
                                         let fm="N/A";
                                         if(row.tipo_doc=='V'){
                                             fm=row.nro_ctrl;
                                         }
                                         return `${fm}`;
                                     }
                                     },

                                 {
                                    "data":"doc",
                                        render: function ( data, type, row ) {
                                            // esto es lo que se va a renderizar como html
                                            let links='';
                                            if(row.tipo_doc=='V'){
                                                links+=row.documento_acreditacion;
                                            }else{

                                                if(row.doc!=""){
                                                    links=`<a href='${ruta+"/"+row.doc}' class='document-link' title='Pasaporte' target='_blank'> Pasaporte </a>`;

                                                }

                                               if(row.documento_acreditacion!=''){
                                                    links+=`<br><a href='${ruta+"/"+row.documento_acreditacion}' class='document-link' title='Documento de Acreditación' target='_blank'>Doc. de Acreditación</a>`;
                                                }

                                            }


                                            return links;
                                        }
                                    },

                                {
                                "data":"nro_doc",
                                    render: function ( data, type, row ) {
                                        // esto es lo que se va a renderizar como html
                                        return `<a href='#' onclick=\"openModalZN('${row.nro_doc}')\"><i class='fa fa-trash text-center' title='Eliminar'></i></a>`;
                                    }
                                }

                             ],

                         });
                         msj.innerHTML="<div class='alert alert-success'>El tripulante se ha agregado de manera exitosa</div>";


                        document.getElementById('funcion').value="";
                        document.getElementById('tipodoc').value="";
                        document.getElementById('nrodoc').value="";
                         document.getElementById('nombres').value="";
                         document.getElementById('apellidos').value="";
                         document.getElementById('sexo').value="";
                         document.getElementById('fecha_nacimiento').value="";
                         document.getElementById('doc').value="";
                         document.getElementById('documentoAcreditacion').value="";
                         document.getElementById('rango').value="";
                     }else{

                         if(funcion=="Capitán"){
                                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+pass['nro_doc']+' no esta permisado para ser capitán esta embarcación.</div>' ;
                            }else{
                                        msj.innerHTML='<div class="alert alert-danger">El marino de C.I.'+pass['nro_doc']+' no esta permisado para tripular esta embarcación.</div>' ;

                        }
                     }

                break;
                default:

                break;
            }

        })

        // This will be called on error
        .fail(function (response) {
            console.log(response);
            console.log('falló validación de Jerarquización ZI');
        });

    }
}

function eliminarTrip(){
    let btn=document.getElementById('btnDelete');
    var cedula=btn.getAttribute('data-ced');
    let msj=document.getElementById('msjMarino');
    let flashMsj=document.getElementById('flashMsj');
    if(flashMsj != null){
        flashMsj.setAttribute('class','');
        flashMsj.innerHTML="";
    }

    let ErrorsFlash=document.getElementById('ErrorsFlash');
    if(ErrorsFlash != null){
        ErrorsFlash.setAttribute('class','');
        ErrorsFlash.innerHTML="";
    }

    $.ajax({
        url: route('deleteTripulante'),
        data: {index: cedula }
    })// This will be called on success
        .done(function (response) {

            let respuesta=JSON.parse(response);
            console.log('EliminarTrip',respuesta);
            if(respuesta[0]==true){
                let tr=document.getElementById(cedula);
                tr.remove();

                msj.innerHTML='<div class="alert alert-success">Tripulante eliminado con éxito.</div>' ;

            }else{
                msj.innerHTML='<div class="alert alert-danger">No se ha podido eliminar el elemento del listado, actualice el navegador e intente nuevamente.</div>' ;
            }
            closeModalZN();
        })
        // This will be called on error
        .fail(function (response) {

        });
}


function openModal(cedula) {
    let btn=document.getElementById('btnDelete');
    btn.setAttribute('data-ced', cedula);
    let ci=document.getElementById('ci');
        ci.innerHTML=cedula;
    document.getElementById("backdrop").style.display = "block";
    document.getElementById("exampleModal").style.display = "block";
    document.getElementById("exampleModal").classList.add("show");
}
function closeModal() {
    document.getElementById("backdrop").style.display = "none";
    document.getElementById("exampleModal").style.display = "none";
    document.getElementById("exampleModal").classList.remove("show");
}

function openModalZN(cedula) {
    let btn=document.getElementById('btnDelete');
    console.log('modalcedula', cedula);
    btn.setAttribute('data-ced', cedula);
    let ci=document.getElementById('ci');
        ci.innerHTML=cedula;
    document.getElementById("backdrop").style.display = "block";
    document.getElementById("modalDeleteTrip").style.display = "block";
    document.getElementById("modalDeleteTrip").classList.add("show");
}
function closeModalZN() {
    document.getElementById("backdrop").style.display = "none";
    document.getElementById("modalDeleteTrip").style.display = "none";
    document.getElementById("modalDeleteTrip").classList.remove("show");
}

function openModalPassengers(tipodoc,cedula, modal){

    $('#numero_identificacionMenor').val("");
    $('#fecha_nacimientoMenor').val("");
    $('#sexoMenor').val("");
    $('#tipodocmenor').val("");
    $('#nombresMenor').val("");
    $('#apellidosMenor').val("");
    $('#representanteMenor').val("");

    document.getElementById('errorModalPass').innerHTML="";

    if(modal==1){
         let btn=document.getElementById('btnDelete');
         let ci=document.getElementById('ci');
         ci.innerHTML=cedula;
        btn.setAttribute('data-ced', cedula);

        document.getElementById("backdrop").style.display = "block";
        document.getElementById("deletePassengerModal").style.display = "block";
        document.getElementById("deletePassengerModal").classList.add("show");
    }else{
        let btn=document.getElementById('btnAdd');
        btn.setAttribute('data-ced', cedula);
        let ci=document.getElementById('ci2');
        ci.innerHTML=tipodoc+'-'+cedula;
        document.getElementById("backdrop").style.display = "block";
        document.getElementById("AddPassengerModal").style.display = "block";
        document.getElementById("AddPassengerModal").classList.add("show");
    }




}

function closeModalPassengers(modal){
    if(modal==1){
         document.getElementById("backdrop").style.display = "none";
        document.getElementById("deletePassengerModal").style.display = "none";
        document.getElementById("deletePassengerModal").classList.remove("show");
    }else{
        document.getElementById("backdrop").style.display = "none";
        document.getElementById("AddPassengerModal").style.display = "none";
        document.getElementById("AddPassengerModal").classList.remove("show");
    }
}
// Get the modal
var modal = document.getElementById('exampleModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    closeModal();
  }
}


function validarCapitan(param){
    if(param==""){
        if($("#cap").is(':checked')){
            var cap="SI";
            $("#cap").prop("checked", false);
            $("#textoCap").text('NO');
        }else{
            var cap="NO";
        }
    }else{

        $("#cap").prop("checked", true);
        $("#textoCap").text('SI');
        var cap="SI";
    }

    return cap;
}





function validarTripulante(documento, capitan) {
    $.ajax({
        url: route('validacionJerarquizacion'),
        data: {doc: documento, cap:capitan }

    })// This will be called on success
        .done(function (response) {
          //  alert(response);
            respuesta = JSON.parse(response);

            //alert(response);
        })

        // This will be called on error
        .fail(function (response) {

            console.log('falló validación de Jerarquización');
        });

}



function addMarino(ids, cap, ci, nombreape, fechav, doc,fechaemision){

    var div=document.getElementById("dataMarinos");
    cantAct=parseInt(div.getAttribute("data-cantMar"));
    let contenedor= document.createElement("div");
    contenedor.id="contentMar"+cantAct;


    let idmar= document.createElement("input");
    let capitan= document.createElement("input");
    let cedula= document.createElement("input");
    let nombre= document.createElement("input");
    let fechaVence= document.createElement("input");
    let documento= document.createElement("input");
    let fechaEmi= document.createElement("input");



     idmar.type="hidden";
     capitan.type="hidden";
     cedula.type="hidden";
     nombre.type="hidden";
     fechaVence.type="hidden";
     documento.type="hidden";
     fechaEmi.type="hidden";


     idmar.name="ids[]";
     capitan.name="capitan[]";
     cedula.name="cedula[]";
     nombre.name="nombre[]";
     fechaVence.name="fechaVence[]";
     documento.name="documento[]";
     fechaEmi.name="fechaEmision[]";


     idmar.value=ids;
     capitan.value=cap;
     cedula.value=ci;
     nombre.value=nombreape;
     fechaVence.value=fechav;
     documento.value=doc;
     fechaEmi.value=fechaemision;


     contenedor.appendChild(idmar);
     contenedor.appendChild(capitan);
     contenedor.appendChild(cedula);
     contenedor.appendChild(nombre);
     contenedor.appendChild(fechaVence);
     contenedor.appendChild(documento);
     contenedor.appendChild(fechaEmi);


     div.appendChild(contenedor);

     div.setAttribute("data-cantMar",cantAct+1);
    console.log(idmar, cap);

}


$('#cap').click(function() {


    if($("#cap").is(':checked')){
        $("#textoCap").text('SI');  // checked
    }
    else{
        $("#textoCap").text('NO');

    }


});




/*FIN validacion paso cinco marinos*/


///**INICION DE VALIDACIONES DE PASO 4 MAPA*//
function compararFechas(){
    var salida =document.getElementById('salida').value;
    var regreso =document.getElementById('regreso');

    regreso.setAttribute("min",salida);
    var date1 = new Date(salida);
    var date2 = new Date(regreso.value);

    if(date1>date2){

        document.getElementById("msjRuta").innerHTML="<div class='alert alert-danger'>La fecha y hora de salida no pueden ser menores que la de regreso, por favor verifique.</div>"
        regreso.value="";
    }

    compararFechasEscala();
}

function equipocheck(id,cantidad,otros){

    check = document.getElementById(id);
    if(check.checked){
        document.getElementById(id+"selected").value="true";
        if(cantidad==true){
            can1=document.getElementById("div_cant"+id);
            can1.style.display='block';
            document.getElementById(id+"cantidad").setAttribute("required",true);
        if (id==1){
            $(".CHALECOS").css('color', 'var(--cui-form-check-label-color, unset)');
        }
        }
        if(otros!=='ninguno'){
            document.getElementById(id+"valores_otros").setAttribute("required",true);
            otros1=document.getElementById("valores_otros"+id);
            otros1.style.display='block';
        }

    }
    else{
        document.getElementById(id+"selected").value="false";
        if(cantidad==true){
            document.getElementById(id+"cantidad").removeAttribute("required");
            cant=document.getElementById("div_cant"+id);
            cant.style.display='none';
        }

        if(otros!=='ninguno'){
            document.getElementById(id+"valores_otros").removeAttribute("required");
            otros=document.getElementById("valores_otros"+id);
            otros.style.display='none';
        }
    }

}

function compararFechasEscala(){
    var salida =document.getElementById('salida').value;
    var regreso =document.getElementById('regreso');
    var escala =document.getElementById('llegada_escala');

    escala.setAttribute("min",salida);
    //alert(regreso.value);
    if(regreso.value!=""){
        escala.setAttribute("max",regreso.value);
    }

    var date1 = new Date(salida);
    var date2 = new Date(escala.value);

    if(date1>date2){

        document.getElementById("msjRuta").innerHTML="<div class='alert alert-danger'>La fecha y hora de salida no pueden ser menores que la de llegada al punto de escala, por favor verifique.</div>"
        escala.value="";
    }

    let date3=new Date(regreso.value);

    if(regreso.value!="" && date2>date3){
        document.getElementById("msjRuta").innerHTML="<div class='alert alert-danger'>La fecha y hora de llegada al punto de escala no pueden ser menores que la fecha de regreso, por favor verifique.</div>"
        regreso.value="";
    }


}

function estNauticoDestinoSelect(idCapitania){

    if(idCapitania==''){
        idCapitania=$("#capitaniaDestinoSelect").children("option:selected").val();
        document.getElementById('capitaniaDestino').value=idCapitania;


    }
    if(idCapitania!=''){
        $.ajax({
        url: route('BuscaEstablecimientosNauticos'),
        data: {idcap: idCapitania }

        })// This will be called on success
            .done(function (response) {
              //  alert(response);
                respuesta = JSON.parse(response);
                let estabecimientos=respuesta[1];
                document.getElementById('capiDestino').innerHTML=" <b>"+respuesta[0].nombre+" </b>";
                let select=document.getElementById("estNautioDestino");
                let options="<option value=''>Seleccione</option>";
                for (var i = 0; i < estabecimientos.length; i++) {
                    options+="<option value='"+estabecimientos[i].id+"'>"+estabecimientos[i].nombre+"</option>"
                }
                select.innerHTML=options;
               //
               // console.log(options);
            })

            // This will be called on error
            .fail(function (response) {
               // respuesta = JSON.parse(response);
                console.log("fallo al buscar establecimientos nautico destino ");
            });
    }

}


//*FIN DE VALIDACIONES DE PASO 4 MAPA*//

//FIN DE VALIDACION DE PERMISOS DE ZARPES

function getCapitania(){

    data=document.getElementById('descripcion_de_navegacion').value;

    $.ajax({
        url: route('FindCapitania'),
        data: {descripcion_de_navegacion: data}

    })// This will be called on success
    .done(function (response) {
        let resp=JSON.parse(response);
        let options="<option value=''>Seleccione</option>";
        for (var i = 0; i < resp.length; i++) {
            options+="<option value='"+resp[i].id+"'>"+resp[i].nombre+"</option>"
        }
        select=document.getElementById('capitania');
        select.innerHTML=options;
       // console.log(options);
    })
        // This will be called on error
    .fail(function (response) {
            console.log(response);
             divError.innerHTML='<div class="alert alert-danger"> Ha ocurrido un error durante la búsqueda de la información.</div>';

    });
}
function requeridos() {
    var roles =  document.getElementById("cargo").value
    if ((roles==5) || (roles==6) ){
        $("#capitanias").prop('required', true);
        $("#establecimiento").prop('required', true);
    } else if ((roles==4) || (roles==7) || (roles==8) ){
        $("#capitanias").prop('required', true);
        $("#establecimiento").prop('required', false);
    } else {
        $("#capitanias").prop('required', false);
        $("#establecimiento").prop('required', false);
    }
}
function cargoCapitaniaUser() {
    var estado = document.getElementById("cargo").value
    if ((estado==5) || (estado==6) ) {
        pref = document.getElementById('divestablecimiento')
        pref.style.display = 'block'
    } else{
            pref=document.getElementById('divestablecimiento')
            pref.style.display='none';
    }
}
function EstablecimientoUser(){
    var estado = document.getElementById("cargo").value
    console.log(estado)
    if ((estado==5) || (estado==6) ){
        pref=document.getElementById('divestablecimiento')
        pref.style.display='block';
        var idCapitania = $("#capitania_id").val();

        $.ajax({
            url: route('AsignarEstablecimiento'),
            data: {idcap: idCapitania }

        })// This will be called on success
            .done(function (response) {
                //  alert(response);
                respuesta = JSON.parse(response);
                let establecimientos=respuesta[0];
                let select=document.getElementById("establecimientos");
                let options="<option value=>Puede asignar un Establecimiento...</option>";
                for (var i = 0; i < establecimientos.length; i++) {
                    options+="<option value='"+establecimientos[i].id+"'>"+establecimientos[i].nombre+"</option>"
                }
                select.innerHTML=options;
                // console.log(options);
            })

            // This will be called on error
            .fail(function (response) {
                console.log("fallo al buscar establecimientos nautico ");
            });
    }else{
        let select=document.getElementById("establecimientos");
        let options="<option value=''>Puede asignar un Establecimiento...</option>";
        select.innerHTML=options;


    }

}

function modalvisita(id,solicitud) {
    var soli = document.getElementById('pago');
    soli.textContent = solicitud
    let frm1 = document.getElementById('visita');
    frm1.setAttribute('action',  route('updateStatus', {id:id,status:4}));
}

function modalaprobacion(id,solicitud) {
    var soli = document.getElementById('solicitud');
    soli.textContent = solicitud
    let frm1 = document.getElementById('form_aprobacion');
    frm1.setAttribute('action',  route('updateStatus', {id:id,status:1}));
}

function modalrechazarestadia(id,solicitud) {
    var soli = document.getElementById('solicitudrechazo');
    soli.textContent = solicitud
    let frm1 = document.getElementById('rechazar-estadia');
    frm1.setAttribute('action',  route('updateStatus', {id:id,status:2}));
}

function modalrechazarzarpe(id,solicitud) {
    var soli = document.getElementById('solicitudzarpe');
    soli.textContent = solicitud
    let frm1 = document.getElementById('rechazar-zarpe');
    frm1.setAttribute('action',  route('status', {id:id,status:'rechazado', capitania: 0}));
}

function modalanularzarpe(id,solicitud) {
    var soli = document.getElementById('nrosolicitud');
    soli.textContent = solicitud
    let frm1 = document.getElementById('anular-zarpe');
    frm1.setAttribute('action',  route('status', {id:id,status:'anular-usuario', capitania: 0}));
}

function cambiar() {
    password1=document.getElementById('password-div')
    if($("#password_change").is(':checked')){
        password1.style.display='block';
    }else {
        password1.style.display='none';
    }
}


$("#tipodocmenor").change(function(){
    let nrodoc=document.getElementById('numero_identificacionMenor');
    let btn=document.getElementById('btnAdd');
    let cedRepresentante=btn.getAttribute('data-ced');
    let representante=document.getElementById('representanteMenor');
    representante.value=cedRepresentante;
    let date = new Date();

    let fechamin=date.getFullYear()-18;
    fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
    fechamin+="-"+String(date.getDate()).padStart(2, '0');
    let str=$(this).val();
   if($(this).val()=='NC'){
    $('.FilePassport').attr('style', 'display:none');

    nrodoc.setAttribute("readOnly", 'readonly');
    nrodoc.value=cedRepresentante;

    fechamin=date.getFullYear()-10;
    fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
    fechamin+="-"+String(date.getDate()).padStart(2, '0');

   }else{
    nrodoc.removeAttribute("readOnly");
    nrodoc.value='';



        let fechamin="";

        if((str=="V")){
            $( "#numero_identificacionMenor").attr('onKeyDown','return soloNumeros(event)');
            $('.FilePassport').attr('style', 'display:none');

                fechamin=date.getFullYear()-18;
                fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
                fechamin+="-"+String(date.getDate()).padStart(2, '0');

        }else if(str=="P"){
            $('.FilePassport').attr('style', 'display:block');
            $('#fecha_nacimientoMenor').attr('min',"" );
            $( "#numero_identificacionMenor").attr('onKeyDown','');
            fechamin=date.getFullYear()-18;
                fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
                fechamin+="-"+String(date.getDate()).padStart(2, '0');
        }else{
            $('.FilePassport').attr('style', 'display:none');

        }
   }

    $('#fecha_nacimientoMenor').attr('min',fechamin );

});

$(document).ready(function() {

    $('.confirmation').on('click', function(event) {
        event.preventDefault();
        var button = $(this);
        accion=button.data('action');

        bootbox.confirm({
            title: "Confirmación",
            message: "Está seguro que desea "+accion+" esta solicitud?",
            centerVertical:true,
            animate:true,
            buttons: {
                confirm: {
                    label: 'Si',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result) {
                    window.location=button.data('route')
                }
            }
        });
    })

        $('.modal-form').on('submit', function(e) {
            e.preventDefault();

            let form1 = e.target;
            var data = $(this).parent().find('.btn-primary').attr('data-action');

            bootbox.confirm({
                title: "Confirmación",
                message: "Está seguro que desea "+data+ " esta solicitud?",
                animate:true,
                buttons: {
                    confirm: {
                        label: 'Si',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result1) {
                    if(result1) {
                        form1.submit();
                    }
                },
            });


        })

    $('.delete-form').on('submit', function(e) {
        e.preventDefault();

        let form = e.target;
        var data = $(this).parent().find('#eliminar').attr('data-mensaje');

        bootbox.confirm({
            title: "Confirmación",
            message: "Está seguro que desea ELIMINAR "+data+"?",
            animate:true,
            buttons: {
                confirm: {
                    label: 'Si',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result1) {
                if(result1) {
                    form.submit();
                }
            },
        });


    })

    });

$('.confirmation_other').on('click', function(event) {
    event.preventDefault();
    var button = $(this);
    accion=button.data('action');

    bootbox.confirm({
        title: "Confirmación",
        message: "Está seguro que desea "+accion+" este registro?",
        centerVertical:true,
        animate:true,
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result) {
                window.location=button.data('route')
            }
        }
    });


})

$(document).ready(function() {
    $("#solicitud").on("click", function() {
        var condiciones = $("#option1").is(":checked");
        var chalecos = $(".CHALECOS").is(":checked");
        if (!condiciones) {
            bootbox.alert({
                message: "Debe Aceptar la Declaratoria!",
                size: 'small',
                centerVertical:true,
                animate:true,
            });
        }else if (!chalecos) {
            bootbox.alert({
                message: "Marque la casilla, Para generar la solicitud es obligatorio incluir la cantidad de salvavidas que tiene en la embarcación!",
                size: 'small',
                centerVertical:true,
                animate:true,
            });
            $(".CHALECOS").css('color', 'red');
        }
    });
});

function soloNumeros(event){
    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
        return false;
    }
}

function calcularEdad(fecha_nacimiento) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha_nacimiento);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad;
}

function validarExtension(idInput, divMsj) {
    // Obtener nombre de archivo
    let archivo = document.getElementById(idInput).value,
    // Obtener extensión del archivo
        extension = archivo.substring(archivo.lastIndexOf('.'),archivo.length);
    // Si la extensión obtenida no está incluida en la lista de valores
    // del atributo "accept", mostrar un error.
    console.log(divMsj);
    var msjMarinoInt=document.getElementById(divMsj);
    msjMarinoInt.innerHTML="";
    var acept=".jpg,.png,.pdf";
    if(acept.split(',').indexOf(extension) < 0) {
    //  alert('Archivo inválido. No se permite la extensión ' + extension);

      msjMarinoInt.innerHTML='<div class="alert alert-danger">Archivo inválido. No se permite la extensión '+extension+'. Sólo son permitidas .pdf, .jpg, .png</div>' ;

      document.getElementById(idInput).value="";
    }
  }


  function noTeclas(event){
      console.log(event.keyCode);
    if(event.keyCode!=37 && event.keyCode!=38 && event.keyCode!=39 && event.keyCode!=40  ){
        return false;
    }
}




$( "#tipodoc" ).change(function () {
    var str = "";
    str =$( "#tipodoc" ).val();
    $( "#nrodoc").val('');
    let date = new Date();
    fechamin=date.getFullYear()-18;
    fechamin+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
    fechamin+="-"+String(date.getDate()).padStart(2, '0');
    if(str=="P"){
      $('.DatosRestantes').attr('style', 'display:block');
      $( "#nrodoc").attr('onKeyDown','');
      $('#fecha_nacimiento').attr('max',fechamin );
    }else{
      $('.DatosRestantes').attr('style', 'display:none');
      $( "#nrodoc").attr('onKeyDown','return soloNumeros(event)');

    }

  })
  .change();

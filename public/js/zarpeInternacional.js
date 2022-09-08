function getmatriculaZI(siglas,destinacion,numero) {
    let divError = document.getElementById("errorMat");
    let table = document.getElementById("table-buque");

    let data1=siglas+'-'+destinacion+'-'+numero;

    if(siglas=="" || destinacion=="" || numero==""){
         divError.innerHTML='<div class="alert alert-danger">Existen campos vacios en el formulario de verificación de matrícula, por favor verifique.</div>';
        table.style.display='none';
    }else{
        $.ajax({
        url: route('validationStepTwo'),
        data: {matricula: data1}

    })// This will be called on success
        .done(function (response) {

              //  alert(response);
console.log(response, 'ZARPE INTERNACIONAL');
            if(response=="NoDeportivaNorecreativa"){
                divError.innerHTML='<div class="alert alert-danger">El sistema actualmente sólo esta habilitado para notificaciones de zarpe de embarcaciones recreativas y/o deportivas, la embarcación de matrícula '+data1+' no cumple con esta condición.</div>';
                table.style.display='none';
            }else if(response=='permisoPorCerrar'){
               // alert('permiso por cerrar');
                divError.innerHTML='<div class="alert alert-danger">La embarcación de matrícula <b>'+data1+'</b> posee un permiso de zarpe que no ha sido cerrado, debe cerrar cualquier permiso de zarpe solicitado previamente para poder realizar uno nuevo.</div>';
                table.style.display='none';

            }else if(response=='sinCoincidenciasMatricula'){
                divError.innerHTML='<div class="alert alert-danger"> La matrícula indicada <b>'+data1+'</b> no existe en RENAVE, por favor verificar </div>';
                table.style.display='none';

            }else if(response=='sinCoincidencias'){
                divError.innerHTML='<div class="alert alert-danger"> Su usuario no está autorizado para realizar solicitudes a nombre de la embarcación de matrícula '+data1+' </div>';
                table.style.display='none';
            }
            else if(response=='noEncontradoSgm'){
                 divError.innerHTML='<div class="alert alert-danger">Matrícula no encontrada en BD seguridad marítima </div>';
                table.style.display='none';
            }else{


                let resp= JSON.parse(response);
                let valiacionSgm=resp.validacionSgm;
                console.log(valiacionSgm);
                let licencia=false;
                let certificado=false;


               if(valiacionSgm[0]==true && valiacionSgm[1]==true && valiacionSgm[2]==true){
                    divError.innerHTML='';
                    table.style.display='block';
                    respuesta=resp.data;
                    matricula=(respuesta[0].matricula_actual);
                    $("#matricula").val(matricula);
                    nombrebuque=(respuesta[0].nombrebuque_actual);
                    $("#nombre").val(nombrebuque);
                    destinacion=(respuesta[0].destinacion);
                    $("#destinacion").val(destinacion);
                    UAB=(respuesta[0].UAB);
                    $("#UAB").val(UAB);
                    ESLORA=(respuesta[0].eslora);
                    $("#eslora").val(ESLORA);
                    nombre_propietario=(respuesta[0].nombre_propietario);
                    $("#nombre_propietario").val(nombre_propietario);
                    numero_identificacion=(respuesta[0].numero_identificacion);
                    $("#numero_identificacion").val(numero_identificacion);
                    manga=(respuesta[0].manga);
                    $("#manga").val(manga);
                   let licenciaNavegacion=valiacionSgm[3].licenciaNavegacion;
                   let fechalicencia=valiacionSgm[4].fecha_vencimientolic;
                   let certificadoRadio=valiacionSgm[3].certificadoRadio;
                   let fechacertificado=valiacionSgm[4].fecha_vencimientocert;
                   let numeroIsmm=valiacionSgm[3].numeroIsmm;
                   let fechaIsmm=valiacionSgm[4].fecha_vencimientoismm;

                   $('#licenciaNavegacion').val(licenciaNavegacion);
                   $('#fechalicencia').val(fechalicencia);
                   $('#certificadoRadio').val(certificadoRadio);
                   $('#fechacertificado').val(fechacertificado);
                   $('#ismm').val(numeroIsmm);
                   $('#fechaIsmm').val(fechaIsmm);
               }else{
                    if(valiacionSgm[0]!=true){
                        divError.innerHTML='<div class="alert alert-danger"> '+valiacionSgm[0]+' </div>';
                        table.style.display='none';
                    }

                    if(valiacionSgm[1]!=true){
                        divError.innerHTML='<div class="alert alert-danger"> '+valiacionSgm[1]+' </div>';
                        table.style.display='none';
                    }

                    if(valiacionSgm[2]!=true){
                        divError.innerHTML='<div class="alert alert-danger"> '+valiacionSgm[2]+' </div>';
                        table.style.display='none';
                    }


                }
            }
        })

        // This will be called on error
        .fail(function (response) {
            console.log(response);
             divError.innerHTML='<div class="alert alert-danger"> Error en la matrícula</div>';
            table.style.display='none';
           // alert('Error en la Matricula');
            table = document.getElementById("table-buque");
            table.style.display='none';
            document.getElementById("matricula").value = "";
            document.getElementById("nombre").value = "";
            document.getElementById("destinacion").value = "";
            document.getElementById("UAB").value = "";
        });
    }



}

function compararFechasZI(){
    var salida =document.getElementById('salida').value;
    var regreso =document.getElementById('llegada');

    regreso.setAttribute("min",salida);
    var date1 = new Date(salida);
    var date2 = new Date(regreso.value);

    if(date1>date2){

        document.getElementById("msjRuta").innerHTML="<div class='alert alert-danger'>La fecha y hora de salida no pueden ser menores que la de llegada a destino, por favor verifique.</div>"
        regreso.value="";
    }


}

function motivoRechazoZI() {
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

function modalrechazarzarpeZI(id,solicitud) {
    var soli = document.getElementById('solicitudzarpe');
    soli.textContent = solicitud
    let frm1 = document.getElementById('rechazar-zarpe');
    frm1.setAttribute('action',  route('statusInt', {id:id,status:'rechazado', capitania: 0}));
}

function getPermisoEstadiaZI(data) {
    divError = document.getElementById("errorPermiso");
    tableEstadiaVAl = document.getElementById("tableEstadiaVAl");


    $.ajax({
        url: route('validationStepTwoE'),
        data: {permiso: data}

    })// This will be called on success
    .done(function (response) {
        let resp=JSON.parse(response);
        console.log(resp);
            if(resp=="sinCoincidencias"){
                divError.innerHTML='<div class="alert alert-danger"> Número de permiso de estadía no encontrado. </div>';
                    tableEstadiaVAl.style.display='none';

            }else if(resp=='permisoPorCerrar'){
                divError.innerHTML='<div class="alert alert-danger">La embarcación con el número de registro <b>'+data+'</b> posee una solicitud de permiso de zarpe que no ha sido cerrado, debe cerrar cualquier permiso de zarpe solicitado previamente para poder realizar uno nuevo.</div>';

                    tableEstadiaVAl.style.display='none';
            }else{
//console.log(resp[0].vencimiento);

    let date1 = new Date();
    let date2 = new Date(resp[0].vencimiento);

                if(date1>date2){

                    divError.innerHTML="<div class='alert alert-danger'>El permiso de estadía se encuentra vencido</div>"

                }else{
                    document.getElementById("solicitud").innerHTML=resp[0].nro_solicitud;
                    document.getElementById("nombre").innerHTML=resp[0].nombre_buque;
                    document.getElementById("nacionalidad").innerHTML=resp[0].nacionalidad_buque;
                    document.getElementById("tipo").innerHTML=resp[0].tipo_buque;
                    document.getElementById("nro_registro").innerHTML=resp[0].nro_registro;
                    var date = new Date(resp[0].vencimiento);
                    vence = date.toLocaleDateString('es-VE');
                    document.getElementById("vigencia").innerHTML=vence;

                    document.getElementById("permiso_de_estadia").value=resp[0].id;
                    document.getElementById("numero_registro").value=resp[0].nro_registro;

                        tableEstadiaVAl.style.display='';
                }



            }

            console.log(resp);
    })

        // This will be called on error
    .fail(function (response) {
            console.log(response);
             divError.innerHTML='<div class="alert alert-danger"> Ha ocurrido un error durante la búsqueda de la información de la embarcación.</div>';
            table.style.display='none';
    });

}

/*

function getDataZI() {
    let cedula= document.getElementById('numero_identificacion').value;
    let fechanac= document.getElementById('fecha_nacimiento').value;
    let sexo= document.getElementById('sexo').value;
    let tipodoc= document.getElementById('tipodoc').value;
    let menor= document.getElementById('menor').value;
    let men='';
    var msj= document.getElementById('msj');
    var pass=document.getElementById('pasajeros');
    const asset=msj.getAttribute('data-asset');

    msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif' width='30px'> &nbsp; Comparando datos con resgitros existentes en SAIME, por favor espere...</div>";

    var div=document.getElementById("dataPassengers");
    cantAct=parseInt(div.getAttribute("data-cant"));
    var cantPasajeros =document.getElementById('cantPasajeros');

    if(cantAct==0 && parseInt(cantPasajeros.innerText)!=0){
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
                    var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                    addPassengersZI(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(), html);
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
                            var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                            msj.innerHTML="";
                            addPassengersZI(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html);
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

                                    var html="<tr id='pass"+cedula+"' data-menor='"+men+"'> <td>"+tipodoc+"-"+cedula+"</td> <td>"+$('#nombres').val()+"</td> <td>"+$('#apellidos').val()+"</td> <td>"+sexo+"</td>  <td>"+fechanac+"</td> <td>"+men+"</td> </tr>";

                                    addPassengersZI(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val(),html);
                                    pass.innerHTML+=html;

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
                                addPassengersZI(men, tipodoc, cedula, fechanac, sexo, $('#nombres').val(), $('#apellidos').val());
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

function addPassengersZI(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos, html){
    //console.log(menor, tipodoc, nrodoc, fechanac, sexo, nombres, apellidos);

    var cantPass= document.getElementById("cantPasajeros");
    let cant=parseInt(cantPass.innerText);

    if(cant > 0){

        cant=cant-1;
        cantPass.innerHTML=cant;
        cantPass.setAttribute("data-cantPass", cant);


        var pass=document.getElementById('pasajeros');
        if(tipodoc!='V'){
            pass.innerHTML+=html;
        }

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

}else{


        let msj= document.getElementById('msj');
        msj.innerHTML='<div class="alert alert-danger">Ha alcanzado la cantidad máxima de pasajeros para esta embarcación.</div>' ;
    }

}*/

function AddPasportsMarinos(){
    let doc=document.getElementById('doc').files[0];
    let docAcreditacion=document.getElementById('documentoAcreditacion').files[0];

    let tipodoc=document.getElementById('tipodocZI').value;

     switch(tipodoc){
        case 'P':

            if (!doc){
                let msj=document.getElementById('msjMarinoInt');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que adjunte el pasaporte.</div>";
                return false;
            }
            if (!docAcreditacion){
                let msj=document.getElementById('msjMarinoInt');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que adjunte el documento de acreditación.</div>";
                return false;
            }

        break;
        case 'V':
            if (!doc){
                let msj=document.getElementById('msjMarinoInt');
                msj.innerHTML="";
                msj.innerHTML="<div class='alert alert-danger'>Se requiere que adjunte el pasaporte.</div>";
                return false;
            }
        break;


     }

    var formData = new FormData();
    formData.append('doc', doc);
    formData.append('documentoAcreditacion', docAcreditacion);


    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: route('AddDocumentosMarinosZI'),
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
                getMarinosZI(documentos);
            }
        }else{
            if(resps[0][0] =='OK'){

                pasaporteName=resps;
                documentos=[resps[0][1],resps[1][1]];
                getMarinosZI(documentos);
            }
        }



    });


}


function getMarinosZI(pass) {
    let funcion= document.getElementById('funcion').value;
    let tipodoc= document.getElementById('tipodocZI').value;
    let nrodoc= document.getElementById('nrodoc').value;
    let nombres= document.getElementById('nombres').value;
    let apellidos= document.getElementById('apellidos').value;
    let rango= document.getElementById('rango').value;
    let sexo= document.getElementById('sexo').value;
    let fechanac= document.getElementById('fecha_nacimiento').value;

    let doc=pass[0];
    let docAcreditacion=pass[1];
    let ruta='';
    let tabla=document.getElementById('marinosZI');
    let msj=document.getElementById('msjMarinoInt');
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

    if(funcion=='' || tipodoc =='' || nrodoc ==''){
        msj.innerHTML="<div class='alert alert-danger'>Existen campos vacios en el formulario, por favor verifique.</div>";
    }else if(tipodoc=='P' && (nombres == '' || apellidos == '' || rango=='' || sexo=='' || fechanac=='')){

        msj.innerHTML="<div class='alert alert-danger'>Existen campos vacios en el formulario, por favor verifique.</div>";

    }else{
         msj.innerHTML='';
        if(tipodoc=='V'){
            ruta=route('validacionMarinoZI');
        }else{
            ruta=route('marinoExtranjeroZI');
        }

        $.ajax({
        url: ruta,
        data: {
            funcion:funcion,
            tipodoc:tipodoc,
            nrodoc:nrodoc,
            nombres:nombres,
            apellidos:apellidos,
            rango:rango,
            doc:doc,
            docAcreditacion:docAcreditacion,
            sexo:sexo,
            fecha_nacimiento:fechanac,

        }

        })// This will be called on success
        .done(function (response) {
          //  alert(response);
            respuesta = JSON.parse(response);

            console.log("RESPUESTAINT::",respuesta);

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
                    msj.innerHTML="<div class='alert alert-danger'>La cédula suministrada no pertenecea a un marino venezolano.</div>";

                break;
                case 'FoundButAssigned':
                            msj.innerHTML='<div class="alert alert-danger">El tripulante C.I. / Pasaporte '+nrodoc+' se encuentra asignado a una embarcación que tiene un zarpe programado o en curso actualmente</div>' ;
                break;
                case 'OK':

                  //  let cantidad=respuesta1.length;


                     if(validacion[0] ==true){


                        var nodataTrip = !!document.getElementById("nodataTrip");

                        if(nodataTrip==true){
                            tabla.innerHTML='';
                        }
                        //let html="<tr id='"+pass['nro_doc']+"'><td> "+pass['funcion']+"</td><td>"+pass['tipo_doc']+"-"+pass['nro_doc']+"</td> <td>"+pass['nombres']+" "+pass['apellidos']+"</td> <td>"+pass['rango']+"</td> <td>"+pass['doc']+"</td><td>  <a href='#' onclick=\"openModalZI('"+pass['nro_doc']+"')\"><i class='fa fa-trash'></i></a></td></tr>";
                       // tabla.innerHTML+=html;
                         pass1=respuesta[0];
                         console.log(pass1);
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

                                 {"data":'rango'},
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
                                            let links=`<a href='${ruta+"/"+row.doc}' class='document-link' title='Pasaporte' target='_blank'> Pasaporte </a>`;
                                            if(row.documento_acreditacion!=''){
                                                links+=`<br><a href='${ruta+"/"+row.documento_acreditacion}' class='document-link' title='Documento de Acreditación' target='_blank'>Doc. de Acreditación</a>`;
                                            }
                                            return links;
                                        }
                                    },

                                {
                                "data":"nro_doc",
                                    render: function ( data, type, row ) {
                                        // esto es lo que se va a renderizar como html
                                        return `<a href='#' onclick=\"openModalZI('${row.nro_doc}')\"><i class='fa fa-trash text-center' title='Eliminar'></i></a>`;
                                    }
                                }

                             ],

                         });
                         msj.innerHTML="<div class='alert alert-success'>El tripulante se ha agregado de manera exitosa</div>";


                        document.getElementById('funcion').value="";
                        document.getElementById('tipodocZI').value="";
                        document.getElementById('nrodoc').value="";
                         document.getElementById('nombres').value="";
                         document.getElementById('apellidos').value="";
                         document.getElementById('rango').value="";
                         document.getElementById('doc').value="";
                         document.getElementById('documentoAcreditacion').value="";
                         document.getElementById('sexo').value="";
                         document.getElementById('fecha_nacimiento').value="";

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

function deleteTripulanteZI(){
    let btn=document.getElementById('btnDelete');
    var cedula=btn.getAttribute('data-ced');
    let msj=document.getElementById('msjMarinoInt');
    let flashMsj=document.getElementById('flashMsj');
    console.log(flashMsj);
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
        url: route('deleteTripulanteZI'),
        data: {index: cedula }
    })// This will be called on success
        .done(function (response) {
            let respuesta = JSON.parse(response);
            console.log("eliminaTripulante:", respuesta);
            if(respuesta[0]==true){
                let tr=document.getElementById(cedula);
                tr.remove();
                msj.innerHTML='<div class="alert alert-success">Tripulante eliminado con éxito.</div>' ;

            }else{
                msj.innerHTML='<div class="alert alert-danger">No se ha podido eliminar el elemento del listado, actualice el navegador e intente nuevamente.</div>' ;
            }
            closeModalZI();
        })
        // This will be called on error
        .fail(function (response) {

        });
}



function openModalZI(cedula) {
    let btn=document.getElementById('btnDelete');
    console.log('modalcedula', cedula);
    btn.setAttribute('data-ced', cedula);
    let ci=document.getElementById('ci');
        ci.innerHTML=cedula;
    document.getElementById("backdrop").style.display = "block";
    document.getElementById("modalDeleteTrip").style.display = "block";
    document.getElementById("modalDeleteTrip").classList.add("show");
}
function closeModalZI() {
    document.getElementById("backdrop").style.display = "none";
    document.getElementById("modalDeleteTrip").style.display = "none";
    document.getElementById("modalDeleteTrip").classList.remove("show");
}






$( "#tipodocZI" ).change(function () {
    var str = "";
    str =$( "#tipodocZI" ).val();
    $( "#nrodoc").val('');
    let date = new Date();
    fechamax=date.getFullYear()-18;
    fechamax+="-"+(String(date.getMonth() + 1).padStart(2, '0'));
    fechamax+="-"+String(date.getDate()).padStart(2, '0');

    if(str=="P"){
      $('.DatosRestantes').attr('style', 'display:block');
      $( "#nrodoc").attr('onKeyDown','');
      $('#fecha_nacimiento').attr('max',fechamax );
    }else{
      $('.DatosRestantes').attr('style', 'display:none');
      $( "#nrodoc").attr('onKeyDown','return soloNumeros(event)');

    }

  })
  .change();

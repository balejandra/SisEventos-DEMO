window.addEventListener('DOMContentLoaded', (evento) => {
    var today = new Date();

// obtener la fecha de hoy en formato `MM/DD/YYYY`
var dias = 15; // Número de días a agregar
    today.setDate(today.getDate()+dias);
    let now = today.toISOString().split('T')[0];
// Asignar valor mínimo
console.log(now)
    document.querySelector('#fecha').min = now
});

function Fecha15dias(){
    var evento =document.getElementById('fecha').value;
    var today = new Date();

// obtener la fecha de hoy en formato `MM/DD/YYYY`
    var dias = 15; // Número de días a agregar
    today.setDate(today.getDate()+dias);
    let now = today.toISOString().split('T')[0];

    if(evento<now){
        document.getElementById("msjRuta").innerHTML="<div class='alert alert-danger'>La solicitud debe realizarse 15 días hábiles antes de la fecha del evento</div>"
        document.getElementById('fecha').value = "";
    }
}



/////////////////////////////////////////////////////////////////

function getmatricula(siglas,destinacion,numero) {
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

                console.log(response);

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


function getPermisoEstadia(data) {
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
                divError.innerHTML='<div class="alert alert-danger">La embarcación con el número de registro <b>'+data+'</b> posee una solicitud de permiso de zarpe que no ha sido cerrada, debe cerrar cualquier permiso de zarpe solicitado previamente para poder realizar uno nuevo.</div>';

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


    })

        // This will be called on error
    .fail(function (response) {

             divError.innerHTML='<div class="alert alert-danger"> Ha ocurrido un error durante la búsqueda de la información de la embarcación.</div>';
            table.style.display='none';
    });

}

function soloNumeros(event){
    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
        return false;
    }
}





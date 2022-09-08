$(document).ready(function() {
    document.getElementById('numero_identificacion').maxLength = 8;
});

function showContent() {
    apellidos = document.getElementById("apellidosdiv");
    fecha=document.getElementById('fechanacimiento')
        apellidos.style.display='none';
        fecha.style.display='none';
        $("#nacimiento").remove();
        $("#apellidosdivint").remove();
        $("#nombres").val("");

    var sel = document.getElementById('tipo_identificacion');
    $("#tipo_identificacion").empty()
    sel.options[0] = new Option('RIF', 'rif');
    $("#tipo_identificacion").val("rif");

    pref=document.getElementById('pref_rif')
    pref.style.display='block';
    document.getElementById("nombres").readOnly = false;
    document.getElementById("nombres").value = '';
    //document.getElementById('numero_identificacion').addEventListener('blur', getVerifiedRIF(1));
    var x = document.getElementById("numero_identificacion");
    x.addEventListener("blur", myBlurFunction, true);
    var btn = document.getElementById("btonregister");
    btn.addEventListener("click", myclikfunction);
    $('#btonregister').prop('type', 'button');
    document.getElementById('numero_identificacion').maxLength = 10;

}

function myBlurFunction() {

    document.getElementById("numero_identificacion").style.backgroundColor = "";
    prefijo=$('#prefijo').val()
    numero=$('#numero_identificacion').val()
    getVerifiedRIF(prefijo+numero)
}
function myclikfunction() {

    prefijo=$('#prefijo').val()
    numero=$('#numero_identificacion').val()
    getVerifiedRIFform(prefijo+numero)
}
function showContentNatural() {
    fecha=document.getElementById('fechanacimiento')
        fecha.style.display='block';
        const birthday = document.querySelector("#fechanacimiento");
        birthday.innerHTML=" <div class=\"input-group mb-3\" id=\"nacimiento\">\n" +
            "                                        <div class=\"input-group-prepend\">\n" +
            "                                            <span class=\"input-group-text\"><i class=\"far fa-calendar-alt\"></i></span>\n" +
            "                                        </div>\n" +
            "                                        <input type=\"date\"\n" +
            "                                               class=\"form-control \"\n" +
            "                                               name=\"fecha_nacimiento\" value=\"{{ old('fecha_nacimiento') }}\" id=\"fecha_nacimiento\"\n" +
            "                                               placeholder=\"fecha_nacimiento\" required onblur=\"getEmployees($('#numero_identificacion').val(),$('#fecha_nacimiento').val())\" >\n" +
            "                                    </div>"
        const apellidos = document.querySelector("#apellidosdiv");
        apellidos.innerHTML="<div id=\"apellidosdivint\">\n" +
            "                                        <div class=\"input-group mb-3\">\n" +
            "                                            <div class=\"input-group-prepend\">\n" +
            "                                                <span class=\"input-group-text\"><i class=\"far fa-user\"></i></span>\n" +
            "                                            </div>\n" +
            "                                            <input type=\"text\"\n" +
            "                                                   class=\"form-control\"\n" +
            "                                                   name=\"apellidos\" id=\"apellidos\"\n" +
            "                                                   placeholder=\"Apellidos\" required>\n" +
            "                                        </div>"
        apellidos.style.display='block';
        $("#tipo_identificacion").val( 'Tipo de Documento');
         $('#btonregister').prop('disabled', true);

    var sel = document.getElementById('tipo_identificacion');
    $("#tipo_identificacion").empty()
    sel.options[0] = new Option('Cedula', 'cedula');
    sel.options[1] = new Option('Pasaporte', 'pasaporte');
    pref=document.getElementById('pref_rif')
    pref.style.display='none';
    var num = document.getElementById("numero_identificacion");
    document.querySelector("#numero_identificacion").listenFor("blur", () => {
        document.querySelector("#numero_identificacion").stopListen("blur");
    });
    document.querySelector("#btonregister").listenFor("click", () => {
        document.querySelector("#btonregister").stopListen("click");
    });
    $('#btonregister').prop('type', 'submit');

}
Element.prototype.listenFor = function(name, callback) {
    // Añadir prototipo listenFor
    this.listenerCallback = callback;
    // Almacenar la función callback en el objeto del elemento
    // Nos servirá para parar el eventListener
    this.addEventListener(name, callback);
    // Añadir el eventListener
}

Element.prototype.stopListen = function(name) {
    this.removeEventListener(name, this.listenerCallback);
    // Recoger la función callback y parar el eventListener
}
function changetipodocumento() {
    //var sel = document.getElementById('tipo_identificacion');
    sel=$("#tipo_identificacion option:selected").text();
    if (sel=='Pasaporte'){
        document.getElementById('numero_identificacion').maxLength = 15;
        $("#nacimiento").remove();
        const birthday = document.querySelector("#fechanacimiento");
        birthday.innerHTML=" <div class=\"input-group mb-3\" id=\"nacimiento\">\n" +
            "                                        <div class=\"input-group-prepend\">\n" +
            "                                            <span class=\"input-group-text\"><i class=\"far fa-calendar-alt\"></i></span>\n" +
            "                                        </div>\n" +
            "                                        <input type=\"date\"\n" +
            "                                               class=\"form-control \"\n" +
            "                                               name=\"fecha_nacimiento\" value=\"{{ old('fecha_nacimiento') }}\" id=\"fecha_nacimiento\"\n" +
            "                                               placeholder=\"fecha_nacimiento\" required>\n" +
            "                                    </div>"
        $('#btonregister').prop('disabled', false);
        document.getElementById("apellidos").readOnly = false;
        document.getElementById("nombres").readOnly = false;
        document.getElementById("nombres").value = '';
        document.getElementById("apellidos").value = '';
    } else if (sel=='Cedula'){
        document.getElementById('numero_identificacion').maxLength = 8;
        $("#nacimiento").remove();
        const birthday = document.querySelector("#fechanacimiento");
        birthday.innerHTML=" <div class=\"input-group mb-3\" id=\"nacimiento\">\n" +
            "                                        <div class=\"input-group-prepend\">\n" +
            "                                            <span class=\"input-group-text\"><i class=\"far fa-calendar-alt\"></i></span>\n" +
            "                                        </div>\n" +
            "                                        <input type=\"date\"\n" +
            "                                               class=\"form-control \"\n" +
            "                                               name=\"fecha_nacimiento\" value=\"{{ old('fecha_nacimiento') }}\" id=\"fecha_nacimiento\"\n" +
            "                                               placeholder=\"fecha_nacimiento\" required onblur=\"getEmployees($('#numero_identificacion').val(),$('#fecha_nacimiento').val())\" >\n" +
            "                                    </div>"
        $('#btonregister').prop('disabled', true);
    } else if (sel=='Rif'){
        console.log('RIF')
        document.getElementById('numero_identificacion').maxLength = 10;
    }

}
    function getEmployees(data1,data2) {
        let msj=document.getElementById('errorRegister');
        const asset=msj.getAttribute('data-asset');
        msj.innerHTML="<div class='alert alert-info'><img src='"+asset+"/load.gif' width='35px' class='mr-2'> Comparando datos con registros existentes en SAIME, por favor espere...</div>";
    $.ajax({
        url: route('consultasaime'),
        data: {cedula: data1, fecha:data2 },
    })// This will be called on success

        .done(function (response) {
          console.log(response,'bien');
          msj.innerHTML="";
            respuesta = JSON.parse(response);
            let tamano = respuesta.length;
            if (tamano == 0) {
                datosbasicos(tamano);
            } else {
                datosbasicos(JSON.parse(response));
            }
            //alert(response);
        })

        // This will be called on error
        .fail(function (response) {
            console.log(response,'error');
            datosbasicos(JSON.parse(0));
            let error=document.getElementById('errorRegister');
            error.innerHTML='<div class="alert alert-danger">No se han encontrado coincidencias en el SAIME con los datos suministrados</div>';
           // alert('No se ha encontrado la cedula o la fecha de nacimiento');
        });

}


function datosbasicos(response) {
    if (response == 0) {

    }else{
        if (response[0].nombre2==null){
            response[0].nombre2=''
        }
        if (response[0].apellido1==null){
            response[0].apellido1=''
        }
        if (response[0].apellido2==null){
            response[0].apellido2=''
        }
        nombrescompletos=(response[0].nombre1)+" "+(response[0].nombre2);
        $("#nombres").val(nombrescompletos);
        document.getElementById("nombres").readOnly = true;
        apellidoscompletos= (response[0].apellido1)+" "+(response[0].apellido2);
        $("#apellidos").val(apellidoscompletos);
        document.getElementById("apellidos").readOnly = true;
        $('#btonregister').prop('disabled', false);
    }

}

function soloNumeros(event){
    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
        return false;
    }
}

function getVerifiedRIF(data1) {
 $.ajax({
        url: route('verifiedRIF'),
        data: {rif: data1 },
    })// This will be called on success

        .done(function (response) {
            console.log(response,'bien');
            $('#btonregister').prop('disabled', false);
            let error=document.getElementById('errorRegister');
            error.innerHTML='';

        })

        // This will be called on error
        .fail(function (response) { console.log(response,'error');
            datosbasicos(JSON.parse(0));
            let error=document.getElementById('errorRegister');
            error.innerHTML='<div class="alert alert-danger">El RIF NO es valido.</div>';
            // alert('No se ha encontrado la cedula o la fecha de nacimiento');
        });

}

function getVerifiedRIFform(data1) {
    $.ajax({
        url: route('verifiedRIF'),
        data: {rif: data1 },
    })// This will be called on success

        .done(function (response) {
            console.log(response,'bien');
            let error=document.getElementById('errorRegister');
            error.innerHTML='';
            document.forms["form_register"].submit();
        })

        // This will be called on error
        .fail(function (response) { console.log(response,'error');
            datosbasicos(JSON.parse(0));
            let error=document.getElementById('errorRegister');
            error.innerHTML='<div class="alert alert-danger">El RIF NO es valido.</div>';
            // alert('No se ha encontrado la cedula o la fecha de nacimiento');
        });

}

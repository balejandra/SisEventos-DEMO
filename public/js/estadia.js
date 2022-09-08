function soloNumeros(event){
    if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
        return false;
    }
}

function EstablecimientoFindNautico(){
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


}

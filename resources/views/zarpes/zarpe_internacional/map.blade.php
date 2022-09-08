@if($solicitud->coordenadas!='')
    @php  
        $sol= json_decode($solicitud->coordenadas);
        $lat=$sol[0];
        $lon=$sol[1];
    @endphp
@else
    @php 
        $lat='';
        $lon='';
    @endphp
@endif
  

<div id="map" style=" heigth:300px;" class="my-3 col-md-12"  data-coordCaps="{{$coordCaps}}" data-coordDepencencias="{{$coordsDependencias}}" data-activarDep="{{$activaDependencias}}" data-coordSelected='' data-coordLatSel='{{$lat}}' data-coordLongSel='{{$lon}}' >

<x-maps-leaflet style='height: 400px' :centerPoint="['lat' => 10.4806, 'long' => -66.9036]"   :zoomLevel="5"></x-maps-leaflet>


	
</div>

<script type="text/javascript">
var divMap=document.getElementById("map");
var activarDep=divMap.getAttribute('data-activarDep');

var dependencias=divMap.getAttribute('data-coordDepencencias');
 dependencias=JSON.parse(dependencias);


var capitanias=document.getElementById("map").getAttribute('data-coordCaps');


capitanias=JSON.parse(capitanias);
var polygon=[];
 var coordenadasCapitanias=[];
 let i=0;
 capitanias.forEach(function(capitania){
 	let idcapi=capitania.capitania;
 	console.log(idcapi);
    if(!activarDep){
 	 polygon[i++] = L.polygon(capitania.coords, {color: 'blue', capitaniaid:idcapi}).addTo(mymap);
    }
 	 
 });
 console.log(dependencias);
 var circles=[];
 let j=0;
 dependencias.forEach(function(dep){
    if(activarDep==true){
        let idcapi2=dep.capitania;
        console.log(dep.coords[0]);
        circles[j++] = L.circle(dep.coords[0], 10000, {
           color: 'red',
           fillColor: '#f03',
           fillOpacity: 0.5,
           capitaniaid: idcapi2
        }).addTo(mymap);    
    }
    
 });

/*Seccion de codigo para marcar en el mapa para marcar cuando se regresa del paso cinco al cuatro*/

let latSel= divMap.getAttribute('data-coordLatSel');
let longSel=divMap.getAttribute('data-coordLongSel');
 
if(latSel!='' && longSel!=''){
    newMarker(latSel, longSel); 
} 

let idcapDestino=divMap.getAttribute("data-idcapdestino");



/*FIN de seccion en el mapa para marcar cuando se regresa del paso cinco al cuatro*/

/*
var circle = L.circle(dep.coords, 25000, {
           color: 'red',
           fillColor: '#f03',
           fillOpacity: 0.5,
           capitaniaid: idcapi
        }).addTo(mymap);
*/


   /* let cordXX=[[7,58],
    [8,59],
    [9,60],
    [10,61],
    [11,62],
    [12,63],
    [13,64],
    [14,65],
    [15,67],
    [16,68],
    [17,69],
    [18,70],
    [19,85]];

     polygonX = L.polygon(cordXX, {color: 'red'}).addTo(mymap);*/
 
 
//var polygon = L.polygon(CoordsCeiba, {color: 'blue', capitaniaid:13}).addTo(mymap);

	 mymap.on('click', onMapClick);
	 var marca; /*variable que guarda la marca que se vera en pantalla al hacer click*/
    function onMapClick(click){
        var coordenada = click.latlng; //capturo las coordenadas latitud y longitud
        /*Busco los input para agregar el valor seleccionado correspondiente latitud y longitud*/
        var latInput=document.getElementById('latitud'); 
        var longInput=document.getElementById('longitud'); 
        /*Busco el atributo data-lat y data-long que guardan la coordenada anterior para eliminar el marcador si es la segunda vez que dan click*/
        let dataLat=latInput.getAttribute("data-lat");
        let dataLong=longInput.getAttribute('data-long');
        /*pregunto si no estan en blanco, porque si tienen informacion es porque ya existe un marcador en el mapa y lo debo eliminar para crear el nuevo*/
        if(dataLat!="" && dataLong!=""){
        	offMapClick(dataLat,dataLong); //borro el marcador anterior del mapa
        } 

        /*Asigno el valor del nuevo click a los input latitud y longitud*/
        latInput.value=coordenada.lat;
        longInput.value=coordenada.lng;

        	/*coloco en los data-lat y data-long las nuevas coordenadas por si en el futuro hay que borrarlas*/
     	latInput.setAttribute('data-lat',coordenada.lat);
     	longInput.setAttribute('data-long',coordenada.lng);
         newMarker(coordenada.lat, coordenada.lng); //Creo la nueva marca en el mapa
         let idCapitania;
         


          if(activarDep){
            circles.forEach(function(cir){
                 
              var distancia= getKilometros(marca ,cir._latlng.lat, cir._latlng.lng);

                  if(distancia<10){
                    // si la distancia es menor a diez km es porque esta dentro del citculo
                    console.log("distancia",distancia, cir.options.capitaniaid);
                    idCapitania=cir.options.capitaniaid;
                     document.getElementById('capitaniaDestino').value=idCapitania; 
                    estNauticoDestinoSelect(idCapitania);
                    
                  }else{
                    idCapitania=false;
                  }

             });
          }else{
            polygon.forEach(function(pol){
                idCapitania=isMarkerInsidePolygon(marca, pol);
                if(idCapitania!=false){
                    document.getElementById('capitaniaDestino').value=idCapitania; 
                    estNauticoDestinoSelect(idCapitania);
                }else{
                    idCapitania=false;
                }

             });
          }
         
        //alert("Acabas de hacer clic en: \n latitud: " + latitud + "\n longitud: " + longitud);
    };

    function offMapClick(lat,  long){
    		let marcaDelete=marca; 
    		//console.log(marcaDelete);

    		mymap.removeLayer(marcaDelete);
    }


    function newMarker(lat, long){
    		//Creo la nueva marca en el mapa

    		 marca=L.marker([lat, long]).addTo(mymap)
	    .bindPopup('Punto de escala de la navegación')
	    .openPopup();
    }





   // var latlngs = [[37, -109.05],[41, -109.03],[41, -102.05],[37, -102.04]];



// zoom the map to the polygon
//mymap.fitBounds(polygon.getBounds());


function isMarkerInsidePolygon(marker, campus) { 
        var inside = false;
        var x = marker.getLatLng().lat, y = marker.getLatLng().lng;
        for (var ii=0;ii<campus.getLatLngs().length;ii++){
            var polyPoints = campus.getLatLngs()[ii];
            for (var i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {
                var xi = polyPoints[i].lat, yi = polyPoints[i].lng;
                var xj = polyPoints[j].lat, yj = polyPoints[j].lng;

                var intersect = ((yi > y) != (yj > y))
                    && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                if (intersect){
                	inside = !inside;
                } 
            }
        }
        if(inside==true){
        	return campus.options.capitaniaid;
        }else{
        	return inside;

        }
    }


    function getKilometros(marker,lat2,lon2)
     {
        var lat1 = marker.getLatLng().lat;
        var lon1 = marker.getLatLng().lng;

        rad = function(x) {return x*Math.PI/180;}
        var R = 6378.137; //Radio de la tierra en km
        var dLat = rad( lat2 - lat1 );
        var dLong = rad( lon2 - lon1 );
        var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(rad(lat1)) * Math.cos(rad(lat2)) * Math.sin(dLong/2) * Math.sin(dLong/2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        var d = R * c;
        return d.toFixed(3); //Retorna tres decimales
     }

 //var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community' });

 
</script>
        
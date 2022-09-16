<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Models\Gmar\LicenciasTitulosGmar;
use App\Models\Publico\Departamento;
use App\Models\Renave\Renave_data;
use App\Models\Transaccion;
use App\Models\SATIM\Pasajero;
use App\Models\SATIM\AutorizacionEvento;
use App\Models\SATIM\PermisoZarpe;
use App\Models\SATIM\Tripulante;
use App\Models\SATIM\EstablecimientoNautico;
use App\Models\SATIM\DescripcionNavegacion;
use App\Models\Publico\Paise;
use App\Models\SATIM\TripulanteInternacional;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
{
    public function imprimir($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=AutorizacionEvento::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Departamento::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=Tripulante::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();

        if($tripulantes[0]->ctrl_documento_id==0 || $tripulantes[0]->ctrl_documento_id=="0"){
            $tripulanteCap=Tripulante::select('*')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();
             $trip = [
            'id' => $tripulanteCap[0]->id,
            'permiso_zarpe_id' => $tripulanteCap[0]->permiso_zarpe_id,
            'ctrl_documento_id' => $tripulanteCap[0]->ctrl_documento_id,
            'capitan' => $tripulanteCap[0]->capitan,
            'funcion' => $tripulanteCap[0]->funcion,
            'nombre' => $tripulanteCap[0]->nombres,
            'apellido' => $tripulanteCap[0]->apellidos,
            'tipo_doc' => $tripulanteCap[0]->tipo_doc,
            'nro_doc'  => $tripulanteCap[0]->nro_doc,
            'doc'  => $tripulanteCap[0]->doc,
            'rango'  => $tripulanteCap[0]->rango,
            'documento_acreditacion'  => $tripulanteCap[0]->documento_acreditacion,
            'fecha_nacimiento'  => $tripulanteCap[0]->fecha_nacimiento,
            'sexo'  => $tripulanteCap[0]->sexo,
            ];
            $trip=(object)$trip;
        }else{
            $trip= LicenciasTitulosGmar::whereIn('id',$tripulantes)->first();
        }

        $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
        $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);

        $pdf=PDF::loadView('PDF.zarpes.permiso',compact('zarpe','buque','trip','capitania','cantPas','cantTrip','estnauticoDestino','DescripcionNavegacion'));
        return $pdf->stream('zarpes.pdf');
    }
    public function imprimirEstadia($id){
        $estadia=AutorizacionEvento::find($id);
        $capitania= Departamento::where('id',$estadia->capitania_id)->first();
        $pdf=PDF::loadView('PDF.estadias.permiso',compact('estadia','capitania'));
        return $pdf->stream('estadia.pdf');
    }

    public function correo($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=AutorizacionEvento::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Departamento::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=Tripulante::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=Tripulante::select('ctrl_documento_id')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();

        if($tripulantes[0]->ctrl_documento_id==0 || $tripulantes[0]->ctrl_documento_id=="0"){
            $tripulanteCap=Tripulante::select('*')->where('permiso_zarpe_id',$id)->where('capitan',true)->get();
             $trip = [
            'id' => $tripulanteCap[0]->id,
            'permiso_zarpe_id' => $tripulanteCap[0]->permiso_zarpe_id,
            'ctrl_documento_id' => $tripulanteCap[0]->ctrl_documento_id,
            'capitan' => $tripulanteCap[0]->capitan,
            'funcion' => $tripulanteCap[0]->funcion,
            'nombre' => $tripulanteCap[0]->nombres,
            'apellido' => $tripulanteCap[0]->apellidos,
            'tipo_doc' => $tripulanteCap[0]->tipo_doc,
            'nro_doc'  => $tripulanteCap[0]->nro_doc,
            'doc'  => $tripulanteCap[0]->doc,
            'rango'  => $tripulanteCap[0]->rango,
            'documento_acreditacion'  => $tripulanteCap[0]->documento_acreditacion,
            'fecha_nacimiento'  => $tripulanteCap[0]->fecha_nacimiento,
            'sexo'  => $tripulanteCap[0]->sexo,
            ];
            $trip=(object)$trip;
        }else{
            $trip= LicenciasTitulosGmar::whereIn('id',$tripulantes)->first();
        }

        $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
        $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $pdf=PDF::loadView('PDF.zarpes.permiso', compact('zarpe','buque','trip','capitania','cantPas','cantTrip','estnauticoDestino','DescripcionNavegacion'))->stream();
        return $pdf;

    }

    public function correoEstadia($id){
       $estadia=AutorizacionEvento::find($id);
        $pdf=PDF::loadView('PDF.autorizacion.evento', compact('estadia'))->stream();
        return $pdf;

    }

    public function imprimirInternacional($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=AutorizacionEvento::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Departamento::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=TripulanteInternacional::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=TripulanteInternacional::select('*')->where('permiso_zarpe_id',$id)->get();
       // dd($tripulantes);
       // $trip= TripulanteInternacional::whereIn('id',$tripulantes)->first();
       // $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
       foreach($tripulantes as $tripulante){
            if($tripulante->funcion=="Capitán"){
                $trip=$tripulante;
            }
       }

       $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $pais= Paise::find($zarpe->paises_id);

        $pdf=PDF::loadView('PDF.zarpeInternacional.permiso',compact('zarpe','buque','trip','capitania','cantPas','cantTrip','DescripcionNavegacion','pais'));
        return $pdf->stream('zarpes.pdf');
    }

    public function correoZI($id){
        $zarpe= PermisoZarpe::find($id);
        if ($zarpe->bandera=='extranjera') {
            $buque=AutorizacionEvento::where('id',$zarpe->permiso_estadia_id)->first();
        }else {
            $buque=Renave_data::where('matricula_actual',$zarpe->matricula)->first();
        }
        $trans= PermisoZarpe::all();
        $zarpe= $trans->find($id);
        $capitania= Departamento::where('id',$zarpe->establecimiento_nautico->capitania_id)->first();
        $cantTrip=TripulanteInternacional::where('permiso_zarpe_id',$id)->get()->count();
        $cantPas=Pasajero::where('permiso_zarpe_id',$id)->get()->count();
        $tripulantes=TripulanteInternacional::select('*')->where('permiso_zarpe_id',$id)->get();
        // dd($tripulantes);
        // $trip= TripulanteInternacional::whereIn('id',$tripulantes)->first();
        // $estnauticoDestino=EstablecimientoNautico::find($zarpe->establecimiento_nautico_destino_id);
        foreach($tripulantes as $tripulante){
            if($tripulante->funcion=="Capitán"){
                $trip=$tripulante;
            }
        }

        $DescripcionNavegacion=DescripcionNavegacion::find($zarpe->descripcion_navegacion_id);
        $pais= Paise::find($zarpe->paises_id);

        $pdf=PDF::loadView('PDF.zarpeInternacional.permiso',compact('zarpe','buque','trip','capitania','cantPas','cantTrip','DescripcionNavegacion','pais'))->stream();
        return $pdf;

    }
}

<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Zarpes\CreatePermisoEstadiaRequest;
use App\Models\Publico\Departamento;
use App\Models\Publico\DepartamentoUser;
use App\Models\User;
use App\Models\SATIM\DocumentoAutorizacion;
use App\Models\SATIM\EstablecimientoNautico;
use App\Models\SATIM\RevisionAutorizacion;
use App\Models\SATIM\AutorizacionEvento;
use App\Models\SATIM\Status;
use App\Models\SATIM\VisitaPermisoEstadia;
use App\Repositories\Zarpes\PermisoEstadiaRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Zarpes\NotificacioneController;

class PermisoEstadiaRenovacionController extends AppBaseController
{
    /** @var  PermisoEstadiaRepository */
    private $permisoEstadiaRepository;

    public function __construct(PermisoEstadiaRepository $permisoEstadiaRepo)
    {
        $this->permisoEstadiaRepository = $permisoEstadiaRepo;
    }

    /**
     * Display a listing of the PermisoEstadia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new PermisoEstadia.
     *
     * @return Response
     */
    public function create($id)
    {
        $permiso= AutorizacionEvento::find($id);
        $nro=substr($permiso->nro_solicitud,0,13);
        $count=AutorizacionEvento::where('nro_registro',$permiso->nro_registro)
            ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)
            ->where('status_id',1)
            ->orWhere('status_id',12)
            ->count();
       // dd($count);
        $cantidadpermisos=$count+1;
        if ($cantidadpermisos==5) {
            Flash::error('Usted ha alcanzado el límite de sus renovaciones');

            return redirect(route('permisosestadia.index'));
        }

        $capitanias = Departamento::all();
        $permiso= AutorizacionEvento::find($id);
        return view('zarpes.permiso_estadias.renovacion.create')
            ->with('capitanias', $capitanias)
            ->with('permiso',$permiso)
            ->with('count',$cantidadpermisos);
    }

    /**
     * Store a newly created PermisoEstadia in storage.
     *
     * @param CreatePermisoEstadiaRequest $request
     *
     * @return Response
     */
    public function store($id, Request $request)
    {
        $validated= $request->validate([
            'nombre_buque' => 'required|string|max:255',
            'nro_registro' => 'required|string|max:255',
            'tipo_buque' => 'required|string|max:255',
            'nacionalidad_buque' =>'required|string|max:255',
            'nombre_propietario' => 'required|string|max:255',
            'pasaporte_capitan' => 'required|string|max:255',
            'nombre_capitan' => 'required|string|max:255',
            'cant_tripulantes' => 'required|numeric|min:1|max:99999999',
            'cant_pasajeros' =>'required|numeric|min:1|max:99999999',
            'arqueo_bruto' => 'required|numeric|min:1|max:99999999',
            'eslora' =>'required|numeric|min:1|max:99999999',
            'potencia_kw' => 'required|numeric|min:1|max:99999999',
            'actividades' => 'required|string|max:255',
            'puerto_origen' => 'required|string|max:255',
            'capitania_id' =>'required|string|max:255',
            'tiempo_estadia' => 'required|string|max:255',
            'fecha_arribo' => 'required|date',
            'manga' => 'required|string|max:255',
            'puntal' => 'required|string|max:255',
            'ultimo_puerto_zarpe' => 'required|string|max:255',
            'establecimiento_nautico_id' => 'required|string|max:255',
        ],
            [
                'nombre_buque.required'=>'El campo Nombre Buque es requerido',
                'nro_registro.required'=>'El campo Numero Registro es requerido',
                'tipo_buque.required'=>'El campo Numero Tipo Buque es requerido',
                'nacionalidad_buque.required'=>'El campo Nacionalidad Buque es requerido',
                'nombre_propietario.required'=>'El campo Nombre Propietario es requerido',
                'pasaporte_capitan.required'=>'El campo Pasaporte Capitán es requerido',
                'nombre_capitan.required'=>'El campo Nombre Capitán es requerido',
                'capitania_id.required'=>'El campo Circunscripción Acuática es requerido',
                'cant_tripulantes.min' => 'Cantidad Tripulantes no puede ser menor a :min caracteres.',
                'cant_tripulantes.required' => 'El campo Cantidad Tripulantes es requerido.',
                'cant_tripulantes.max' => 'Cantidad Tripulantes no puede ser mayor a :max caracteres.',
                'arqueo_bruto.min' => 'Arqueo Bruto no puede ser menor a :min caracteres.',
                'arqueo_bruto.required' => 'El campo Arqueo Bruto es requerido.',
                'arqueo_bruto.max' => 'Arqueo Bruto  no puede ser mayor a :max caracteres.',
                'cant_pasajeros.min' => 'Cantidad máxima de personas a bordo no puede ser menor a :min caracteres.',
                'cant_pasajeros.required' => 'El campo Cantidad máxima de personas a bordo es requerido.',
                'cant_pasajeros.max' => 'Cantidad máxima de personas a bordo no puede ser mayor a :max caracteres.',
                'potencia_kw.min' => 'Potencia KW no puede ser menor a :min caracteres.',
                'potencia_kw.required' => 'El campo Potencia KW es requerido.',
                'potencia_kw.max' => 'Potencia KW no puede ser mayor a :max caracteres.',
                'actividades.required'=>'El campo  Actividades que realizará es requerido',
                'puerto_origen.required'=>'El campo Puerto de Origen / País es requerido',
                'tiempo_estadia.required'=>'El campo Vigencia es requerido',
                'fecha_arribo.required'=>'El campo de Fecha de Arribo es requerido',
                'ultimo_puerto_zarpe.required'=>'El campo Zarpe Último Puerto es requerido',
                'establecimiento_nautico_id.required'=>'El campo Permanencia en la Marina es requerido',

            ]
        );
        $permiso=AutorizacionEvento::find($id);
        $nro=substr($permiso->nro_solicitud,0,13);
        //dd($nro_solicitud);
        $count=AutorizacionEvento::where('nro_registro',$permiso->nro_registro)
            ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)
            ->count();
      // dd($count);
        $cantidadpermisos=$count+1;

        $aprobados=AutorizacionEvento::where('nro_registro',$permiso->nro_registro)
            ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)
            ->where('status_id',1)
            ->orWhere('status_id',12)
            ->count();
       //dd($aprobados);
        $cantaprobados=$aprobados+1;
        //dd($permiso->id);
//dd($nro.".".$cantidadpermisos);
        $estadia = new AutorizacionEvento();
        $estadia->nro_solicitud = $nro.".$cantidadpermisos";
        $estadia->cantidad_solicitud=$cantaprobados;
        $estadia->user_id = auth()->user()->id;
        $estadia->nombre_buque = $request->nombre_buque;
        $estadia->nro_registro = $request->nro_registro;
        $estadia->tipo_buque = $request->tipo_buque;
        $estadia->nacionalidad_buque = $request->nacionalidad_buque;
        $estadia->nombre_propietario = $request->nombre_propietario;
        $estadia->pasaporte_capitan = $request->pasaporte_capitan;
        $estadia->nombre_capitan = $request->nombre_capitan;
        $estadia->cant_tripulantes = $request->cant_tripulantes;
        $estadia->cant_pasajeros = $request->cant_pasajeros;
        $estadia->arqueo_bruto = $request->arqueo_bruto;
        $estadia->eslora = $request->eslora;
        $estadia->potencia_kw = $request->potencia_kw;
        $estadia->actividades = $request->actividades;
        $estadia->puerto_origen = $request->puerto_origen;
        $estadia->capitania_id = $request->capitania_id;
        $estadia->tiempo_estadia = $request->tiempo_estadia;
        $estadia->fecha_arribo = $request->fecha_arribo;
        $estadia->manga = $request->manga;
        $estadia->puntal = $request->puntal;
        $estadia->ultimo_puerto_zarpe = $request->ultimo_puerto_zarpe;
        $estadia->establecimiento_nautico_id = $request->establecimiento_nautico_id;
        $estadia->status_id = 3;
        $estadia->save();


        if ($request->hasFile('zarpe_procedencia')) {
            $documento1 = new DocumentoAutorizacion();
            $procedencia = $request->file('zarpe_procedencia');
            $filenamepro = date('dmYGi') . $procedencia->getClientOriginalName();
            $filenamepronew = str_replace(' ','',$filenamepro);
            $avatar1 = $procedencia->move(public_path() . '/documentos/permisoestadia', $filenamepronew);
            $documento1->permiso_estadia_id = $estadia->id;
            $documento1->documento = $filenamepronew;
            $documento1->recaudo = 'Zarpe de Procedencia';
            $documento1->save();
        }
        if ($request->hasFile('registro_embarcacion')) {
            $documento2 = new DocumentoAutorizacion();
            $registro = $request->file('registro_embarcacion');
            $filenamereg = date('dmYGi') . $registro->getClientOriginalName();
            $filenameregnew = str_replace(' ','',$filenamereg);
            $avatar2 = $registro->move(public_path() . '/documentos/permisoestadia', $filenameregnew);
            $documento2->permiso_estadia_id = $estadia->id;
            $documento2->documento = $filenameregnew;
            $documento2->recaudo = 'Registro de Embarcación';
            $documento2->save();
        }
        if ($request->hasFile('despacho_aduana_procedencia')) {
            $documento3 = new DocumentoAutorizacion();
            $migracion = $request->file('despacho_aduana_procedencia');
            $filenamemig = date('dmYGi') . $migracion->getClientOriginalName();
            $filenamemignew = str_replace(' ','',$filenamemig);
            $avatar3 = $migracion->move(public_path() . '/documentos/permisoestadia', $filenamemignew);
            $documento3->permiso_estadia_id = $estadia->id;
            $documento3->documento = $filenamemignew;
            $documento3->recaudo = 'Despacho de Aduana de Procedencia';
            $documento3->save();
        }
        if ($request->hasFile('pasaportes_tripulantes')) {
            $documento4 = new DocumentoAutorizacion();
            $pasaportes = $request->file('pasaportes_tripulantes');
            $filenamepas = date('dmYGi') . $pasaportes->getClientOriginalName();
            $filenamepasnew = str_replace(' ','',$filenamepas);
            $avatar4 = $pasaportes->move(public_path() . '/documentos/permisoestadia', $filenamepasnew);
            $documento4->permiso_estadia_id = $estadia->id;
            $documento4->documento = $filenamepasnew;
            $documento4->recaudo = 'Pasaportes de Tripulantes';
            $documento4->save();
        }

        if ($request->hasFile('nominacion_agencia')) {
            $documento5 = new DocumentoAutorizacion();
            $nominacion = $request->file('nominacion_agencia');
            $filenamenom = date('dmYGi') . $nominacion->getClientOriginalName();
            $filenamenomnew = str_replace(' ','',$filenamenom);
            $avatar5 = $nominacion->move(public_path() . '/documentos/permisoestadia', $filenamenomnew);
            $documento5->permiso_estadia_id = $estadia->id;
            $documento5->documento = $filenamenomnew;
            $documento5->recaudo = 'Nominación Agencia Naviera';
            $documento5->save();
        }

        $this->SendMail($estadia->id, 1, true);
        $this->SendMail($estadia->id, 0, false);
        Flash::success('Solicitud de Permiso Estadía guardada satisfactoriamente.');

        return redirect(route('permisosestadia.index'));

    }

    /**
     * Display the specified PermisoEstadia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified PermisoEstadia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified PermisoEstadia in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

    }


    public function SendMail($idsolicitud, $tipo, $mailUser)
    {
        $solicitud = AutorizacionEvento::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);
        $rolecapitan=Role::find(4);
        $rolecoordinador=Role::find(7);
        $capitanDestino = DepartamentoUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecapitan->id)
            ->get();


        $coordinador = DepartamentoUser::select('capitania_id', 'email')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecoordinador->id)
            ->get();
        //  dd($coordinador);
        $notificacion = new NotificacioneController();

        if ($tipo == 1) {
            if ( isset($coordinador[0]->email)) {
                //mensaje para capitania origen
                $mensaje = "El sistema de control y gestión de zarpes del INEA le notifica que ha recibido una nueva solicitud de permiso
    de Estadía en su jurisdicción que espera por su asignación de visita.";
                $mailTo = $coordinador[0]->email;
                $subject = 'Nueva solicitud de renovación de permiso de estadía ' . $solicitud->nro_solicitud;
            }else {

            }

        } else {
            if ( isset($capitanDestino[0]->email)) {
                //mensaje para capitania destino
                $mensaje = "El sistema de control y gestión de zarpes del INEA le notifica que
    la siguiente embarcación Internacional tiene una solicitud para arribar a su jurisdicción.";
                $mailTo = $capitanDestino[0]->email;
                $subject = 'Notificación de arribo Internacional ' . $solicitud->nro_solicitud;
            }else {

            }
        }

        if( $mailUser==true){
            $emailUser = new MailController();
            $mensajeUser = "El sistema de control y gestion de zarpes del INEA le notifica que ha generado una nueva solicitud de renovación
            de permiso de Estadía con su usuario y se espera de asignación de visita.";
            $dataUser = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->nro_registro,
                'nombre_buque' => $solicitud->nombre_buque,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'mensaje' => $mensaje,
            ];
            $view = 'emails.estadias.solicitud';
            $subject = 'Nueva solicitud de renovación de permiso de Estadía ' . $solicitud->nro_solicitud;
            $emailUser->mailZarpe($solicitante->email, $subject, $dataUser, $view);
            $notificacion->storeNotificaciones($solicitud->user_id, $subject, $mensajeUser, "Permiso de Estadía");

        }


        $data = [
            'solicitud' => $solicitud->nro_solicitud,
            'matricula' => $solicitud->nro_registro,
            'nombre_buque' => $solicitud->nombre_buque,
            'nombres_solic' => $solicitante->nombres,
            'apellidos_solic' => $solicitante->apellidos,
            'mensaje' => $mensaje,
        ];
        $email=new MailController();
        $view = 'emails.estadias.solicitud';

        $email->mailZarpe($mailTo, $subject, $data, $view);
    }


    /**
     * Remove the specified PermisoEstadia from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {

    }
}

<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Zarpes\CreatePermisoEstadiaRequest;
use App\Models\Publico\Departamento;
use App\Models\Publico\DepartamentoUser;
use App\Models\Publico\Paise;
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
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use App\Http\Controllers\Zarpes\NotificacioneController;


class PermisoEstadiaController extends AppBaseController
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
        $user = auth()->id();
        if (auth()->user()->hasPermissionTo('listar-estadia-todos')) {
            $permisoEstadias = $this->permisoEstadiaRepository->all();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);

        } else if (auth()->user()->hasPermissionTo('listar-estadia-generados')) {
            $permisoEstadias = AutorizacionEvento::where('user_id', $user)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);

        } else if (auth()->user()->hasPermissionTo('listar-estadia-coordinador')) {
            $coordinador = DepartamentoUser::select('capitania_id')
                ->where('user_id', $user)
                ->where('habilitado',true)
                ->get();
            $permisoEstadias = AutorizacionEvento::whereIn('capitania_id', $coordinador)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);

        } else if (auth()->user()->hasPermissionTo('listar-estadia-capitania-destino')) {
            $capitania = DepartamentoUser::select('capitania_id')
                ->where('user_id', $user)
                ->where('habilitado',true)
                ->get();
            $permisoEstadias = AutorizacionEvento::whereIn('capitania_id', $capitania)->get();
            return view('zarpes.permiso_estadias.index')
                ->with('permisoEstadias', $permisoEstadias);

        } else {
            return view('unauthorized');
        }
    }

    /**
     * Show the form for creating a new PermisoEstadia.
     *
     * @return Response
     */
    public function create()
    {
        $Establecimientos = EstablecimientoNautico::all();
        $capitanias = Departamento::all();
        $paises = Paise::all();
        return view('zarpes.permiso_estadias.create')
            ->with('establecimientos', $Establecimientos)
            ->with('capitanias', $capitanias)
            ->with('paises',$paises);
    }

    /**
     * Store a newly created PermisoEstadia in storage.
     *
     * @param CreatePermisoEstadiaRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
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
                'pasaporte_capitan.required'=>'El campo Pasaporte Capit??n es requerido',
                'nombre_capitan.required'=>'El campo Nombre Capit??n es requerido',
                'capitania_id.required'=>'El campo Circunscripci??n Acu??tica es requerido',
                'cant_tripulantes.min' => 'Cantidad Tripulantes no puede ser menor a :min caracteres.',
                'cant_tripulantes.required' => 'El campo Cantidad Tripulantes es requerido.',
                'cant_tripulantes.max' => 'Cantidad Tripulantes no puede ser mayor a :max caracteres.',
                'arqueo_bruto.min' => 'Arqueo Bruto no puede ser menor a :min caracteres.',
                'arqueo_bruto.required' => 'El campo Arqueo Bruto es requerido.',
                'arqueo_bruto.max' => 'Arqueo Bruto  no puede ser mayor a :max caracteres.',
                'cant_pasajeros.min' => 'Cantidad m??xima de personas a bordo no puede ser menor a :min caracteres.',
                'cant_pasajeros.required' => 'El campo Cantidad m??xima de personas a bordo es requerido.',
                'cant_pasajeros.max' => 'Cantidad m??xima de personas a bordo no puede ser mayor a :max caracteres.',
                'potencia_kw.min' => 'Potencia KW no puede ser menor a :min caracteres.',
                'potencia_kw.required' => 'El campo Potencia KW es requerido.',
                'potencia_kw.max' => 'Potencia KW no puede ser mayor a :max caracteres.',
                'actividades.required'=>'El campo  Actividades que realizar?? es requerido',
                'puerto_origen.required'=>'El campo Puerto de Origen / Pa??s es requerido',
                'tiempo_estadia.required'=>'El campo Vigencia es requerido',
                'fecha_arribo.required'=>'El campo de Fecha de Arribo es requerido',
                'ultimo_puerto_zarpe.required'=>'El campo Zarpe ??ltimo Puerto es requerido',
                'establecimiento_nautico_id.required'=>'El campo Permanencia en la Marina es requerido',

]
            );

        $matriculaexis=AutorizacionEvento::where('nro_registro',$request->nro_registro)
            ->where('status_id',1)
            ->first();
        if ($matriculaexis) {
            Flash::error('Este Nro. de Registro del Buque ya tiene una solicitud aprobada.');

            return redirect()->back();
        }else {
            $notificacion = new NotificacioneController();

            $estadia = new AutorizacionEvento();
            $estadia->nro_solicitud = $this->codigo($request->capitania_id);
            $estadia->cantidad_solicitud = '1';
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
                $documento2->recaudo = 'Registro de Embarcaci??n';
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
                $documento5->recaudo = 'Nominaci??n Agencia Naviera';
                $documento5->save();
            }

            $this->SendMail($estadia->id, 1, true);
            $this->SendMail($estadia->id, 0, false);
            Flash::success('Su Solicitud de Permiso de Estad??a se ha generado satisfactoriamente.');

            return redirect(route('permisosestadia.index'));
        }
    }

    private function codigo($capitania_id)
    {
        $capitania = Departamento::find($capitania_id);
        $idcap=$capitania->id;
        $cantidadActual = AutorizacionEvento::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where('cantidad_solicitud',1)
            ->where(DB::raw("(SUBSTR(nro_solicitud,6,4) = '" . date('Y') . "')"), '=', true)
            ->Join('public.capitanias', function ($join) use ($idcap) {
                $join->on('permiso_estadias.capitania_id', '=', 'public.capitanias.id')
                    ->where('public.capitanias.id', '=',  $idcap);
            })
            ->get();

        $capitania = Departamento::find($capitania_id);

        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = $capitania->sigla . "-" . date('Y') . date('m') . "-" . $correlativo;
       //dd($codigo);
        return $codigo;
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
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);
        $documentos = DocumentoAutorizacion::where('permiso_estadia_id', $id)->get();
        $revisiones=RevisionAutorizacion::where('permiso_estadia_id',$id)->get();
        $visita=VisitaPermisoEstadia::where('permiso_estadia_id',$id)->get();
        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estad??a no encontrado');

            return redirect(route('permisoEstadias.index'));
        }

        return view('zarpes.permiso_estadias.show')
            ->with('permisoEstadia', $permisoEstadia)
            ->with('documentos', $documentos)
            ->with('revisiones',$revisiones)
            ->with('visitas',$visita);
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
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);
        $documentos = DocumentoAutorizacion::where('permiso_estadia_id', $id)->get();
        $capitanias = Departamento::all();
        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estad??a no encontrado');

            return redirect(route('permisoEstadias.index'));
        }

        return view('zarpes.permiso_estadias.edit')
            ->with('permisoEstadia', $permisoEstadia)
            ->with('documentos',$documentos)
            ->with('capitanias',$capitanias);
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
        $permisoEstadia = $this->permisoEstadiaRepository->find($id);

        if (empty($permisoEstadia)) {
            Flash::error('Permiso Estad??a no encontrado');

            return redirect(route('permisoEstadias.index'));
        }

        if ($request->hasFile('permiso_seniat')) {
            $documento1 = new DocumentoAutorizacion();
            $seniat = $request->file('permiso_seniat');
            $filenamesen = date('dmYGi') . $seniat->getClientOriginalName();
            $filenamesennew = str_replace(' ','',$filenamesen);
            $avatar1 = $seniat->move(public_path() . '/documentos/permisoestadia', $filenamesennew);
            $documento1->permiso_estadia_id = $id;
            $documento1->documento = $filenamesennew;
            $documento1->recaudo = 'Permiso de Admisi??n Temporal emitida por el SENIAT';
            $documento1->save();
        }
        if ($request->hasFile('comprobante_alicuota')) {
            $documento2 = new DocumentoAutorizacion();
            $alicuota = $request->file('comprobante_alicuota');
            $filenamealic = date('dmYGi') . $alicuota->getClientOriginalName();
            $filenamealicnew = str_replace(' ','',$filenamealic);
            $avatar2 = $alicuota->move(public_path() . '/documentos/permisoestadia', $filenamealicnew);
            $documento2->permiso_estadia_id = $id;
            $documento2->documento = $filenamealicnew;
            $documento2->recaudo = 'Comprobante de pago de Al??cuota';
            $documento2->save();
        }
        if ($request->hasFile('inspeccion_visita')) {
            $documento3 = new DocumentoAutorizacion();
            $inspeccion = $request->file('inspeccion_visita');
            $filenameinsp = date('dmYGi') . $inspeccion->getClientOriginalName();
            $filenameinspnew = str_replace(' ','',$filenameinsp);
            $avatar3 = $inspeccion->move(public_path() . '/documentos/permisoestadia', $filenameinspnew);
            $documento3->permiso_estadia_id = $id;
            $documento3->documento = $filenameinspnew;
            $documento3->recaudo = 'Inspecci??n por el Visitador';
            $documento3->save();
        }
        if ($request->hasFile('comprobante_saime')) {
            $documento4 = new DocumentoAutorizacion();
            $saime = $request->file('comprobante_saime');
            $filenamesai = date('dmYGi') . $saime->getClientOriginalName();
            $filenamesainew = str_replace(' ','',$filenamesai);
            $avatar4 = $saime->move(public_path() . '/documentos/permisoestadia', $filenamesainew);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenamesainew;
            $documento4->recaudo = 'Comprobante de visita SAIME';
            $documento4->save();
        }
        if ($request->hasFile('comprobante_insai')) {
            $documento4 = new DocumentoAutorizacion();
            $insai = $request->file('comprobante_insai');
            $filenameins = date('dmYGi') . $insai->getClientOriginalName();
            $filenameinsnew = str_replace(' ','',$filenameins);
            $avatar4 = $insai->move(public_path() . '/documentos/permisoestadia', $filenameinsnew);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenameinsnew;
            $documento4->recaudo = 'Comprobante de visita INSAI';
            $documento4->save();
        }
        if ($request->hasFile('pago_permisoEstadia')) {
            $documento4 = new DocumentoAutorizacion();
            $pestadia = $request->file('pago_permisoEstadia');
            $filenameest = date('dmYGi') . $pestadia->getClientOriginalName();
            $filenameestnew = str_replace(' ','',$filenameest);
            $avatar4 = $pestadia->move(public_path() . '/documentos/permisoestadia', $filenameestnew);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenameestnew;
            $documento4->recaudo = 'Pago del Permiso Especial de Estad??a';
            $documento4->save();
        }
        if ($request->hasFile('comprobante_ochina')) {
            $documento4 = new DocumentoAutorizacion();
            $ochina = $request->file('comprobante_ochina');
            $filenameoch = date('dmYGi') . $ochina->getClientOriginalName();
            $filenameochnew = str_replace(' ','',$filenameoch);
            $avatar4 = $ochina->move(public_path() . '/documentos/permisoestadia', $filenameochnew);
            $documento4->permiso_estadia_id = $id;
            $documento4->documento = $filenameochnew;
            $documento4->recaudo = 'Comprobante de pago a OCHINA';
            $documento4->save();
        }
        $estadia= AutorizacionEvento::find($id);
        $idstatus = Status::find(11);
        $estadia->status_id = $idstatus->id;
        $estadia->update();

        RevisionAutorizacion::create([
            'user_id' => auth()->user()->id,
            'permiso_estadia_id' => $id,
            'accion' => $idstatus->nombre,
            'motivo' => 'Pendiente para aprobaci??n'
        ]);

        Flash::success('Recaudos cargados satisfactoriamente.');

        return redirect(route('permisosestadia.index'));
    }

    public function updateStatus($id, $status)
    {

        $email = new MailController();
        $notificacion = new NotificacioneController();
           if ($status=== "9") {
               $visitador = $_GET['visitador'];
               $fecha_visita = $_GET['fecha_visita'];

               $estadia= AutorizacionEvento::find($id);
               $idstatus = Status::find(9);
               $solicitante = User::find($estadia->user_id);
               $estadia->status_id = $idstatus->id;
               $estadia->update();

               RevisionAutorizacion::create([
                   'user_id' => auth()->user()->id,
                   'permiso_estadia_id' => $id,
                   'accion' => $idstatus->nombre,
                   'motivo' => 'Visitador asignado'
               ]);

               VisitaPermisoEstadia::create([
                   'permiso_estadia_id' => $id,
                   'nombre_visitador' => $visitador,
                   'fecha_visita' => $fecha_visita,
               ]);
               $data = [
                   'solicitud' => $estadia->nro_solicitud,
                   'id'=>$id,
                   'nombres_solic' => $solicitante->nombres,
                   'apellidos_solic' => $solicitante->apellidos,
                   'matricula' => $estadia->nro_registro,
                   'visitador' => $visitador,
                   'fecha_visita'=>$fecha_visita,
               ];
               $view = 'emails.estadias.visita';
               $subject = 'Solicitud de Permiso de Estad??a ' . $estadia->nro_solicitud;
               $mensaje="Saludos, a su Solicitud de Permiso de Estad??a N?? ".$estadia->nro_solicitud." se le ha asignado un visitador, con el siguiente detalle:";
               $mensaje.=" <br><b>Buque Registro Nro.:</b> ".$estadia->nro_registro." <br> <b>Solicitante:</b> ".$solicitante->nombres." ".$solicitante->apellidos." <br> <b>Visitador:</b> ".$visitador." <br> <b>Fecha de la visita:</b> ".$fecha_visita;

               $notificacion->storeNotificaciones($estadia->user_id, $subject,  $mensaje, "Permiso de Estad??a");
               $email->mailZarpe($solicitante->email, $subject, $data, $view);

               Flash::success('Visitador asignado y notificaci??n enviada al solicitante.');
               return redirect(route('permisosestadia.index'));
           } if ($status==='10') {
                $estadia= AutorizacionEvento::find($id);
                $idstatus = Status::find(10);
                $estadia->status_id = $idstatus->id;
                $estadia->update();

                RevisionAutorizacion::create([
                    'user_id' => auth()->user()->id,
                    'permiso_estadia_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => 'Visita aprobada, por favor suba los recaudos faltantes'
                ]);
                Flash::success('Visita aprobada.');
                return redirect(route('permisosestadia.index'));
           } if ($status==='1') {

                $estadia= AutorizacionEvento::find($id);
                if ($estadia->cantidad_solicitud>1) {
                   // dd($estadia->cantidad_solicitud);
                    $ant=($estadia->cantidad_solicitud-1);
                    $nro=substr($estadia->nro_solicitud,0,13);
                    //dd($nro);
                    $status = Status::find(12);
                    $anterior=AutorizacionEvento::where('cantidad_solicitud',$ant)
                        ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)
                        ->update(['status_id' => $status->id]);
                    $query=AutorizacionEvento::where('cantidad_solicitud',$ant)
                        ->where(DB::raw("(SUBSTR(nro_solicitud,1,13) = '" . $nro . "')"), '=', true)->get()->last();
                   // dd($query->id);
                    RevisionAutorizacion::create([
                        'user_id' => auth()->user()->id,
                        'permiso_estadia_id' => $query->id,
                        'accion' => $status->nombre,
                        'motivo' => 'Renovaci??n'
                    ]);

                }
                $idstatus = Status::find(1);
                $estadia->status_id = $idstatus->id;
                $date = date("d-m-Y");

                $vencimiento = strtotime($date."+ 90 days");
                $vencimiento= date("Y-m-d",$vencimiento);
                $estadia->vencimiento = $vencimiento;
                $estadia->update();
                RevisionAutorizacion::create([
                    'user_id' => auth()->user()->id,
                    'permiso_estadia_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => 'Estad??a Aprobada'
                ]);

        if ($estadia->cantidad_solicitud==4) {
            $subject = 'Solicitud de Estad??a ??ltima Renovaci??n ' . $estadia->nro_solicitud;

            $mensaje="Su solicitud de Permiso de Estad??a N??: ".$estadia->nro_solicitud." registrada ha sido ". $idstatus->nombre. ". Puede verificar
    su documento de autorizaci??n de estad??a en el archivo adjunto a este correo.
    Se le recuerda que esta es su ??ltima renovaci??n.";

        }else {
            $subject = 'Solicitud de Estad??a ' . $estadia->nro_solicitud;
            $mensaje = "Su solicitud de Permiso de Estad??a N??: " . $estadia->nro_solicitud . " registrada ha sido" . $idstatus->nombre . ". Puede verificar
    su documento de autorizaci??n de estad??a en el archivo adjunto a este correo.";
        }

        $this->SendMailAprobacion($estadia->id, $mensaje,$subject);

        $notificacion->storeNotificaciones($estadia->user_id, $subject,  $mensaje, "Permiso de Estad??a");

                Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
                return redirect(route('permisosestadia.index'));
           } if ($status==='2') {
                $motivo = $_GET['motivo'];
                $estadia= AutorizacionEvento::find($id);
                $idstatus = Status::find(2);
                $estadia->status_id = $idstatus->id;
                if ($estadia->cantidad_solicitud==1) {
                    $estadia->cantidad_solicitud = 1;
                } else{
                    $estadia->cantidad_solicitud = 0;
                }
                $estadia->update();
                $solicitante = User::find($estadia->user_id);
                RevisionAutorizacion::create([
                    'user_id' => auth()->user()->id,
                    'permiso_estadia_id' => $id,
                    'accion' => $idstatus->nombre,
                    'motivo' => $motivo
                ]);
        $mensaje = "Su solicitud de Permiso de Estad??a N??: " . $estadia->nro_solicitud . " registrada ha sido " . $idstatus->nombre;
                $data = [
                    'solicitud' => $estadia->nro_solicitud,
                    'id'=>$id,
                    'idstatus' => $idstatus->id,
                    'status' => $idstatus->nombre,
                    'matricula' => $estadia->nro_registro,
                    'nombre_buque' => $estadia->nombre_buque,
                    'motivo' => $motivo,
                    'mensaje' =>$mensaje,
                ];
                $view = 'emails.estadias.revision';
                $subject = 'Solicitud de Permiso de Estad??a ' . $estadia->nro_solicitud;
                $email->mailZarpe($solicitante->email, $subject, $data, $view);
                $notificacion->storeNotificaciones($estadia->user_id, $subject,  $mensaje.' motivado a '.$motivo, "Permiso de Estad??a");

                Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
                return redirect(route('permisosestadia.index'));
           }
    }

    public function SendMail($idsolicitud, $tipo,$mailUser)
    {
        $solicitud = AutorizacionEvento::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);
        $rolecapitan=Role::find(4);
        $rolecoordinador=Role::find(7);
        $capitanDestino = DepartamentoUser::select('capitania_id', 'email','user_id')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecapitan->id)
            ->get();
        //dd($capitanDestino);-

        $coordinador = DepartamentoUser::select('capitania_id', 'email','user_id')
            ->Join('users', 'users.id', '=', 'user_id')
            ->where('capitania_id', '=', $solicitud->capitania_id)
            ->where('cargo', $rolecoordinador->id)
            ->get();
        //dd($coordinador);
        $notificacion = new NotificacioneController();

        $mensaje = "";
        $mailTo="";
        $idTo="";
        $subject="";

        if ($tipo == 1) {
          if ( isset($coordinador[0]->email)) {
              $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que ha recibido una nueva solicitud de permiso
    de Estad??a en su jurisdicci??n que espera por su asignaci??n de visita.";
              $mailTo = $coordinador[0]->email;
              $idTo=$coordinador[0]->user_id;
              $subject = 'Nueva solicitud de permiso de Estad??a ' . $solicitud->nro_solicitud;
          }else{
          }

        } else {
            if ( isset($capitanDestino[0]->email)) {
                $mensaje = "El sistema de control y gestion de zarpes del INEA le notifica que
    la siguiente embarcaci??n Internacional tiene una solicitud para arribar a su jurisdicci??n.";
                $mailTo = $capitanDestino[0]->email;
                $idTo=$capitanDestino[0]->user_id;

                $subject = 'Notificaci??n de arribo Internacional ' . $solicitud->nro_solicitud;
            }else {

            }
        }

        if( $mailUser==true){
            $emailUser = new MailController();
            $mensajeUser = "El sistema de control y gestion de zarpes del INEA le notifica que ha generado una nueva solicitud de permiso
            de Estad??a con su usuario y se espera de asignaci??n de visita.";
            $dataUser = [
                'solicitud' => $solicitud->nro_solicitud,
                'matricula' => $solicitud->nro_registro,
                'nombre_buque' => $solicitud->nombre_buque,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'mensaje' => $mensaje,
            ];
            $view = 'emails.estadias.solicitud';
            $subject = 'Nueva solicitud de permiso de Estad??a ' . $solicitud->nro_solicitud;
            $emailUser->mailZarpe($solicitante->email, $subject, $dataUser, $view);
            $notificacion->storeNotificaciones($solicitud->user_id, $subject, $mensajeUser, "Permiso de Estad??a");

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
        $notificacion->storeNotificaciones($idTo, $subject,  $mensaje, "Permiso de Estad??a");

    }

    public function SendMailAprobacion($idsolicitud, $mensaje,$subject)
    {
        $solicitud = AutorizacionEvento::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);
        $idstatus = Status::find(1);
        $notificacion = new NotificacioneController();

        $data = [
            'solicitud' => $solicitud->nro_solicitud,
            'id'=>$idsolicitud,
            'idstatus' => $idstatus->id,
            'status' => $idstatus->nombre,
            'matricula' => $solicitud->nro_registro,
            'nombre_buque' => $solicitud->nombre_buque,
            'mensaje'=>$mensaje,
        ];

        $email=new MailController();
        $view = 'emails.estadias.revision';

        $email->mailEstadiaPDF($solicitante->email, $subject, $data, $view);
        $notificacion->storeNotificaciones($solicitud->user_id, $subject,  $mensaje, "Permiso de Estad??a");

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

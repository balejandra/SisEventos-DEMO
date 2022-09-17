<?php

namespace App\Http\Controllers\SATIM;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Zarpes\MailController;
use App\Http\Controllers\Zarpes\NotificacioneController;
use App\Models\Publico\Petro;
use App\Models\SATIM\AutorizacionEvento;
use App\Models\SATIM\DocumentoAutorizacion;
use App\Models\SATIM\PagoEvento;
use App\Models\SATIM\RevisionAutorizacion;
use App\Models\SATIM\Status;
use App\Models\User;
use App\Repositories\SATIM\AutorizacionEventoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Response;


class AutorizacionEventoController extends Controller
{

    /** @var AutorizacionEventoRepository */
    private $autorizacionEventoRepository;

    public function __construct(AutorizacionEventoRepository $autorizacionEventoRepo)
    {
        $this->autorizacionEventoRepository = $autorizacionEventoRepo;
    }

    /**
     * Display a listing of the AutorizacionEvento.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = auth()->id();
        if (auth()->user()->hasPermissionTo('listar-eventos-todos')) {
            $permisoEstadias = $this->autorizacionEventoRepository->all();
            return view('autorizacion_eventos.index')
                ->with('autorizacionEventos', $permisoEstadias);

        } else if (auth()->user()->hasPermissionTo('listar-eventos-generados')) {
            $permisoEstadias = AutorizacionEvento::where('user_id', $user)->get();
            return view('autorizacion_eventos.index')
                ->with('autorizacionEventos', $permisoEstadias);
        } else {
            return view('unauthorized');
        }

    }

    /**
     * Show the form for creating a new AutorizacionEvento.
     *
     * @return Response
     */
    public function create()
    {
        return view('autorizacion_eventos.create');
    }

    /**
     * Store a newly created AutorizacionEvento in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_evento' => 'required|string|max:255',
            'fecha' => 'required|date',
            'horario' => 'required|date_format:H:i',
            'lugar' => 'required|string|max:255',
            'cant_organizadores' => 'required|numeric|min:1|max:99999999',
            'cant_asistentes' => 'required|numeric|min:1|max:99999999',
            'nombre_contacto' => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:255',
            'email_contacto' => 'required|string|max:255',
        ]);

        $estadia = new AutorizacionEvento();
        $estadia->nro_solicitud = $this->codigo();
        $estadia->user_id = auth()->user()->id;
        $estadia->nombre_evento = $request->nombre_evento;
        $estadia->fecha = $request->fecha;
        $estadia->horario = $request->horario;
        $estadia->lugar = $request->lugar;
        $estadia->cant_organizadores = $request->cant_organizadores;
        $estadia->cant_asistentes = $request->cant_asistentes;
        $estadia->nombre_contacto = $request->nombre_contacto;
        $estadia->telefono_contacto = $request->telefono_contacto;
        $estadia->email_contacto = $request->email_contacto;
        $estadia->status_id = 3;
        $estadia->save();

        if ($request->hasFile('cedula')) {
            $documento1 = new DocumentoAutorizacion();
            $cedula = $request->file('cedula');
            $filenamepro = date('dmYGi') . $cedula->getClientOriginalName();
            $filenamepronew = str_replace(' ', '', $filenamepro);
            $avatar1 = $cedula->move(public_path() . '/documentos/autorizacionevento', $filenamepronew);
            $documento1->autorizacion_evento_id = $estadia->id;
            $documento1->documento = $filenamepronew;
            $documento1->recaudo = 'Cédula de Identidad del Solicitante y responsable Legal';
            $documento1->save();
        }
        if ($request->hasFile('RIF')) {
            $documento2 = new DocumentoAutorizacion();
            $registro = $request->file('RIF');
            $filenamereg = date('dmYGi') . $registro->getClientOriginalName();
            $filenameregnew = str_replace(' ', '', $filenamereg);
            $avatar2 = $registro->move(public_path() . '/documentos/autorizacionevento', $filenameregnew);
            $documento2->autorizacion_evento_id = $estadia->id;
            $documento2->documento = $filenameregnew;
            $documento2->recaudo = 'Registro de Información Fiscal (RIF) Vigente';
            $documento2->save();
        }
        if ($request->hasFile('acta_constitutiva')) {
            $documento3 = new DocumentoAutorizacion();
            $migracion = $request->file('acta_constitutiva');
            $filenamemig = date('dmYGi') . $migracion->getClientOriginalName();
            $filenamemignew = str_replace(' ', '', $filenamemig);
            $avatar3 = $migracion->move(public_path() . '/documentos/autorizacionevento', $filenamemignew);
            $documento3->autorizacion_evento_id = $estadia->id;
            $documento3->documento = $filenamemignew;
            $documento3->recaudo = 'Registro de Información Fiscal (RIF) de la empresa (Vigente) (en caso de ser una persona jurídica)';
            $documento3->save();
        }
        if ($request->hasFile('listado_comidas')) {
            $documento4 = new DocumentoAutorizacion();
            $pasaportes = $request->file('listado_comidas');
            $filenamepas = date('dmYGi') . $pasaportes->getClientOriginalName();
            $filenamepasnew = str_replace(' ', '', $filenamepas);
            $avatar4 = $pasaportes->move(public_path() . '/documentos/autorizacionevento', $filenamepasnew);
            $documento4->autorizacion_evento_id = $estadia->id;
            $documento4->documento = $filenamepasnew;
            $documento4->recaudo = 'Listado de comidas que se consumirán';
            $documento4->save();
        }

        if ($request->hasFile('listado_bebidas')) {
            $documento5 = new DocumentoAutorizacion();
            $nominacion = $request->file('listado_bebidas');
            $filenamenom = date('dmYGi') . $nominacion->getClientOriginalName();
            $filenamenomnew = str_replace(' ', '', $filenamenom);
            $avatar5 = $nominacion->move(public_path() . '/documentos/autorizacionevento', $filenamenomnew);
            $documento5->autorizacion_evento_id = $estadia->id;
            $documento5->documento = $filenamenomnew;
            $documento5->recaudo = 'Listado de bebidas que se consumirán';
            $documento5->save();
        }

        if ($request->hasFile('listado_precios')) {
            $documento6 = new DocumentoAutorizacion();
            $fileorig6 = $request->file('listado_precios');
            $filename6 = date('dmYGi') . $fileorig6->getClientOriginalName();
            $filenamenew6 = str_replace(' ', '', $filename6);
            $avatar5 = $fileorig6->move(public_path() . '/documentos/autorizacionevento', $filenamenew6);
            $documento6->autorizacion_evento_id = $estadia->id;
            $documento6->documento = $filenamenew6;
            $documento6->recaudo = 'Listado de Precio por persona que será cancelado por el evento (si aplica)';
            $documento6->save();
        }

        if ($request->hasFile('listado_equipos')) {
            $documento7 = new DocumentoAutorizacion();
            $fileorig7 = $request->file('listado_equipos');
            $filename7 = date('dmYGi') . $fileorig7->getClientOriginalName();
            $filenamenew7 = str_replace(' ', '', $filename7);
            $avatar5 = $fileorig7->move(public_path() . '/documentos/autorizacionevento', $filenamenew7);
            $documento7->autorizacion_evento_id = $estadia->id;
            $documento7->documento = $filenamenew7;
            $documento7->recaudo = 'Listado de equipos a utilizar (si aplica)';
            $documento7->save();
        }

        if ($request->hasFile('pago_solicitud')) {
            $documento8 = new DocumentoAutorizacion();
            $fileorig8 = $request->file('pago_solicitud');
            $filename8 = date('dmYGi') . $fileorig8->getClientOriginalName();
            $filenamenew8 = str_replace(' ', '', $filename8);
            $avatar5 = $fileorig8->move(public_path() . '/documentos/autorizacionevento', $filenamenew8);
            $documento8->autorizacion_evento_id = $estadia->id;
            $documento8->documento = $filenamenew8;
            $documento8->recaudo = 'Pago de Tasa de Solicitud';
            $documento8->save();
        }

        Flash::success('Su Solicitud de Autorización de evento se ha generado satisfactoriamente.');

        return redirect(route('autorizacionEventos.index'));

    }

    private function codigo()
    {
        $cantidadActual = AutorizacionEvento::select(DB::raw('count(nro_solicitud) as cantidad'))
            ->where(DB::raw("(SUBSTR(nro_solicitud,8,8) = '" . date('Y') . "')"), '=', true)
            ->get();

        $correlativo = $cantidadActual[0]->cantidad + 1;
        $codigo = "SOAE-" . $correlativo . "-" . date('Y');
        //  dd($codigo);
        return $codigo;
    }


    /**
     * Display the specified AutorizacionEvento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);
        $documentos = DocumentoAutorizacion::where('autorizacion_evento_id', $id)->get();
        $revisiones = RevisionAutorizacion::where('autorizacion_evento_id', $id)->get();
        $pago=PagoEvento::where('autorizacion_evento_id',$id)->get();

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        return view('autorizacion_eventos.show')
            ->with('autorizacionEvento', $autorizacionEvento)
            ->with('documentos', $documentos)
            ->with('revisiones', $revisiones)
            ->with('pagos', $pago);
    }

    /**
     * Show the form for editing the specified AutorizacionEvento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        return view('autorizacion_eventos.edit')->with('autorizacionEvento', $autorizacionEvento);
    }

    /**
     * Update the specified AutorizacionEvento in storage.
     *
     * @param int $id
     * @param UpdateAutorizacionEventoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutorizacionEventoRequest $request)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        $autorizacionEvento = $this->autorizacionEventoRepository->update($request->all(), $id);

        Flash::success('Autorizacion Evento updated successfully.');

        return redirect(route('autorizacionEventos.index'));
    }

    /**
     * Remove the specified AutorizacionEvento from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $autorizacionEvento = $this->autorizacionEventoRepository->find($id);

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('autorizacionEventos.index'));
        }

        $this->autorizacionEventoRepository->delete($id);

        Flash::success('Autorizacion Evento deleted successfully.');

        return redirect(route('autorizacionEventos.index'));
    }


    public function updateStatus($id, $status)
    {
        $notificacion = new NotificacioneController();

        if ($status === '1') {
            $petrodia=Petro::select("monto")->latest()->first();
            $monto_pagar_petros = $_GET['monto_pagar_petros'];
            $estadia = AutorizacionEvento::find($id);
            $solicitante = User::find($estadia->user_id);
            $idstatus = Status::find(1);
            $estadia->status_id = $idstatus->id;

            $estadia->update();
            RevisionAutorizacion::create([
                'user_id' => auth()->user()->id,
                'autorizacion_evento_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Autorización Evento Aprobada'
            ]);

            $pago = new PagoEvento();
            $pago->autorizacion_evento_id = $id;
            $pago->monto_pagar_petros = $monto_pagar_petros;
            $pago->monto_pagar_bolivares = ($monto_pagar_petros * $petrodia->monto);
            $pago->save();

            $subject = 'Solicitud de Autorización de Evento ' . $estadia->nro_solicitud;
            $mensaje = "Su solicitud de Autorización de Evento N°: " . $estadia->nro_solicitud . " registrada ha sido " . $idstatus->nombre . ". Puede verificar
    su documento de autorización de evento en el archivo adjunto a este correo.";

            $data = [
                'id' => $id,
                'solicitud' => $estadia->nro_solicitud,
                'nombre_evento' => $estadia->nombre_evento,
                'idstatus' => $idstatus->id,
                'hora' => $estadia->hora,
                'fecha' => $estadia->fecha,
                'mensaje' => $mensaje,
            ];

            $email = new MailController();
            $view = 'emails.estadias.revision';

            $email->mailEventoPDF($solicitante->email, $subject, $data, $view);
            $notificacion->storeNotificaciones($estadia->user_id, $subject, $mensaje, "Solicitud de Autorización de Evento");

            Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
            return redirect(route('autorizacionEventos.index'));
        }
        if ($status === '2') {
            $motivo = $_GET['motivo'];
            $estadia = AutorizacionEvento::find($id);
            $idstatus = Status::find(2);
            $estadia->status_id = $idstatus->id;
            $estadia->update();
            $solicitante = User::find($estadia->user_id);
            RevisionAutorizacion::create([
                'user_id' => auth()->user()->id,
                'autorizacion_evento_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => $motivo
            ]);
            $subject = 'Solicitud de Autorización de Evento ' . $estadia->nro_solicitud;
            $mensaje = "Su solicitud de Autorización de Evento N°: " . $estadia->nro_solicitud . " registrada ha sido " . $idstatus->nombre;

            $this->SendMailAprobacion($estadia->id, $mensaje, $subject);

            Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
            return redirect(route('autorizacionEventos.index'));

        }
        if ($status === "4") {
            $forma_pago = $_GET['forma_pago'];
            $codigo_transaccion = $_GET['codigo_transaccion'];
            $fecha_pago = $_GET['fecha_pago'];

            $estadia = AutorizacionEvento::find($id);
            $idstatus = Status::find(4);
            $solicitante = User::find($estadia->user_id);
            $estadia->status_id = $idstatus->id;
            $estadia->update();

            RevisionAutorizacion::create([
                'user_id' => auth()->user()->id,
                'autorizacion_evento_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Pago Aprobado'
            ]);

            $pago = PagoEvento::where('autorizacion_evento_id', $id)->first();
            $pago->forma_pago = $forma_pago;
            $pago->codigo_transaccion = $codigo_transaccion;
            $pago->fecha_pago = $fecha_pago;
            $pago->update();
            $data = [
                'solicitud' => $estadia->nro_solicitud,
                'id' => $id,
                'nombres_solic' => $solicitante->nombres,
                'apellidos_solic' => $solicitante->apellidos,
                'nombre_evento' => $estadia->nombre_evento,
                'codigo_transaccion' => $codigo_transaccion,
                'forma_pago' => $forma_pago,
            ];
            $view = 'emails.estadias.pago';
            $subject = 'Pago Aprobado Autorizacion de Evento ' . $estadia->nro_solicitud;
            $mensaje = "Su solicitud de Autorización de Evento N°: " . $estadia->nro_solicitud . " registrada ha sido aprobado el pago satisfactoriamente";
            $notificacion->storeNotificaciones($estadia->user_id, $subject, $mensaje, "Pago Aprobado Autorizacion de Evento");
            $email2 = new MailController();
            $email2->mailEvento($solicitante->email, $subject, $data, $view);

            Flash::success('Pago Aprobado y notificación enviada al solicitante.');
            return redirect(route('eventosPorPagar.index'));
        }
        if ($status === '6') {
            $estadia = AutorizacionEvento::find($id);
            $idstatus = Status::find(6);
            $estadia->status_id = $idstatus->id;
            $estadia->update();
            RevisionAutorizacion::create([
                'user_id' => auth()->user()->id,
                'autorizacion_evento_id' => $id,
                'accion' => $idstatus->nombre,
                'motivo' => 'Anulacion'
            ]);

            Flash::error('Solicitud anulada satisfactoriamente.');
            return redirect(route('autorizacionEventos.index'));

        }
    }

    public function SendMailAprobacion($idsolicitud, $mensaje, $subject)
    {
        $solicitud = AutorizacionEvento::find($idsolicitud);
        $solicitante = User::find($solicitud->user_id);
        $idstatus = Status::find(1);
        $notificacion = new NotificacioneController();

        $data = [
            'solicitud' => $solicitud->nro_solicitud,
            'id' => $idsolicitud,
            'idstatus' => $idstatus->id,
            'status' => $idstatus->nombre,
            'nombre_evento' => $solicitud->nombre_evento,
            'fecha' => $solicitud->fecha,
            'hora' => $solicitud->hora,
            'mensaje' => $mensaje,
        ];

        $email = new MailController();
        $view = 'emails.estadias.revision';

        $email->mailEvento($solicitante->email, $subject, $data, $view);
        $notificacion->storeNotificaciones($solicitud->user_id, $subject, $mensaje, "Solicitud de Autorización de Evento");

    }


}

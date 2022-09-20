<?php

namespace App\Http\Controllers\SATIM;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Zarpes\MailController;
use App\Http\Controllers\Zarpes\NotificacioneController;
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


class EventoPorPagarController extends Controller{

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
        if (auth()->user()->hasPermissionTo('listar-evento-porpagar')) {

            $permisoEstadias = AutorizacionEvento::where('status_id', 1)->get();
            return view('evento_por_pagar.index')
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
        $revisiones=RevisionAutorizacion::where('autorizacion_evento_id',$id)->get();
        $pagos=PagoEvento::where('autorizacion_evento_id',$id)->get();

        if (empty($autorizacionEvento)) {
            Flash::error('Autorizacion Evento not found');

            return redirect(route('eventosPorPagar.index'));
        }
//dd($autorizacionEvento);
        return view('evento_por_pagar.show')
            ->with('autorizacionEvento', $autorizacionEvento)
            ->with('documentos', $documentos)
            ->with('revisiones',$revisiones)
            ->with('pagos',$pagos);
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

    }

    /**
     * Remove the specified AutorizacionEvento from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {

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

           /* VisitaPermisoEstadia::create([
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
            $subject = 'Solicitud de Permiso de Estadía ' . $estadia->nro_solicitud;
            $mensaje="Saludos, a su Solicitud de Permiso de Estadía N° ".$estadia->nro_solicitud." se le ha asignado un visitador, con el siguiente detalle:";
            $mensaje.=" <br><b>Buque Registro Nro.:</b> ".$estadia->nro_registro." <br> <b>Solicitante:</b> ".$solicitante->nombres." ".$solicitante->apellidos." <br> <b>Visitador:</b> ".$visitador." <br> <b>Fecha de la visita:</b> ".$fecha_visita;

            $notificacion->storeNotificaciones($estadia->user_id, $subject,  $mensaje, "Permiso de Estadía");
            $email->mailZarpe($solicitante->email, $subject, $data, $view);*/

            Flash::success('Visitador asignado y notificación enviada al solicitante.');
            return redirect(route('permisosestadia.index'));

    } if ($status==='1') {
        $monto_pagar_petros = $_GET['monto_pagar_petros'];
        $estadia= AutorizacionEvento::find($id);
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

        $pago= new PagoEvento();
        $pago->autorizacion_evento_id=$id;
        $pago->monto_pagar_petros=$monto_pagar_petros;
        $pago->monto_pagar_bolivares=($monto_pagar_petros*481.7640);
        $pago->save();

            $subject = 'Solicitud de Autorización de Evento ' . $estadia->nro_solicitud;
            $mensaje = "Su solicitud de Autorización de Evento N°: " . $estadia->nro_solicitud . " registrada ha sido " . $idstatus->nombre;

        $data = [
            'id'=>$id,
            'solicitud' => $estadia->nro_solicitud,
            'nombre' => $estadia->nombre_evento,
            'lugar' => $estadia->lugar,
            'fecha' => $estadia->fecha,
            'mensaje' => $mensaje,
        ];

        $email=new MailController();
        $view = 'emails.estadias.solicitud';

        $email->mailEventoPDF($solicitante->email, $subject, $data, $view);
        $notificacion->storeNotificaciones($estadia->user_id, $subject,  $mensaje, "Solicitud de Autorización de Evento");

        Flash::success('Solicitud aprobada y correo enviado al usuario solicitante.');
        return redirect(route('autorizacionEventos.index'));
    } if ($status==='2') {
        $motivo = $_GET['motivo'];
        $estadia= AutorizacionEvento::find($id);
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

        $this->SendMailAprobacion($estadia->id, $mensaje,$subject);

        Flash::error('Solicitud rechazada y correo enviado al usuario solicitante.');
        return redirect(route('autorizacionEventos.index'));
    }
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
            'nombre_evento' => $solicitud->nombre_evento,
            'fecha' => $solicitud->fecha,
            'hora' => $solicitud->hora,
            'mensaje'=>$mensaje,
        ];

        $email=new MailController();
        $view = 'emails.estadias.revision';

        $email->mailEvento($solicitante->email, $subject, $data, $view);
        $notificacion->storeNotificaciones($solicitud->user_id, $subject,  $mensaje, "Autorización de Evento");

    }


}

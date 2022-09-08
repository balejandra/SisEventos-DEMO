<?php

namespace App\Console\Commands;

use App\Http\Controllers\Zarpes\MailController;
use App\Http\Controllers\Zarpes\NotificacioneController;
use App\Models\Publico\CapitaniaUser;
use App\Models\User;
use App\Models\SATIM\PermisoZarpe;
use App\Models\SATIM\Status;
use App\Models\SATIM\ZarpeRevision;
use Illuminate\Console\Command;

class VerificationZarpeRescate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification:zarperescate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificacion tiempos de zarpes mayor a 2 horas notificacion email para rescate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $zarpeVencido=PermisoZarpe::whereRaw('fecha_hora_regreso::TIMESTAMP + \'2 hr\'::INTERVAL <= now() and
                                                  fecha_hora_regreso::TIMESTAMP + \'3 hr\'::INTERVAL >= now()')
            ->where('status_id',5)
            ->where('descripcion_navegacion_id','<>','4')
            ->get();
        $notificacion = new NotificacioneController();
        foreach($zarpeVencido as $record){

            $zarpeRescate=PermisoZarpe::where('id',$record->id)
                ->update(['status_id'=>14]);

            $userc=CapitaniaUser::where('capitania_id',$record->destino_capitania_id)
                ->where('habilitado',true)
                ->get();

            foreach($userc as $record2) {
                $userEmail = User::find($record2->user_id);
                $email = new MailController();
                $data = [
                    'codigo'=>$record->nro_solicitud,
                    'buque'=>$record->matricula,
                    'hora_llegada'=>$record->fecha_hora_regreso,
                ];
                $view = 'emails.zarpes.rescate';
                $subject = 'Notificación de Rescate Nacional ' . $record->nro_solicitud;
                $mensaje="Saludos, Notificación URGENTE, la siguiente embarcación presenta 2 horas de retraso de su arribo a destino programado.
                Nro. de Solicitud: {$record->nro_solicitud}, Buque Matrícula Nro: {$record->matricula}, Fecha Llegada: {$record->fecha_hora_regreso}";
                $notificacion->storeNotificaciones($record2->user_id, $subject,  $mensaje, "Zarpe Nacional");
                $email->mailZarpe($userEmail->email, $subject, $data, $view);
            }

                ZarpeRevision::insert([
                    'user_id' => 1,
                    'permiso_zarpe_id' => $record->id,
                    'accion'=>'Informado Rescate',
                    'motivo'=>'Pasada 2 horas de navegacion sin informar arribo'
                ]);
        }

        //INTERNACIONAL////
        $zarpeIVencido=PermisoZarpe::whereRaw('fecha_hora_regreso::TIMESTAMP + \'2 hr\'::INTERVAL <= now() and
                                                  fecha_hora_regreso::TIMESTAMP + \'3 hr\'::INTERVAL >= now()')
            ->where('status_id',5)
            ->where('descripcion_navegacion_id','4')
            ->get();
        $notificacionI = new NotificacioneController();
        foreach($zarpeIVencido as $recordI){
            $zarpeRescateI=PermisoZarpe::where('id',$recordI->id)
                ->update(['status_id'=>14]);
            $usercI=CapitaniaUser::where('capitania_id',$recordI->destino_capitania_id)
                ->where('habilitado',true)
                ->get();

            foreach($usercI as $record2I) {
                $userEmailI = User::find($record2I->user_id);
                $emailI = new MailController();
                $dataI = [
                    'codigo'=>$recordI->nro_solicitud,
                    'buque'=>$recordI->matricula,
                    'hora_llegada'=>$recordI->fecha_hora_regreso,
                ];
                $viewI = 'emails.zarpes.rescate';
                $subjectI = 'Notificacion de Rescate Internacional ' . $recordI->nro_solicitud;
                $mensajeI="Saludos, Notificacion URGENTE, la siguiente embarcación presenta 2 horas de retraso de su arribo a destino programado.
                Nro. de Solicitud: {$recordI->nro_solicitud}, Buque Matrícula Nro: {$recordI->matricula}, Fecha Llegada: {$recordI->fecha_hora_regreso}";
                $notificacionI->storeNotificaciones($record2I->user_id, $subjectI,  $mensajeI, "Zarpe Internacional");
                $emailI->mailZarpe($userEmailI->email, $subjectI, $dataI, $viewI);
            }
            ZarpeRevision::insert([
                'user_id' => 1,
                'permiso_zarpe_id' => $recordI->id,
                'accion'=>'Informado Rescate',
                'motivo'=>'Pasada 2 horas de navegacion sin informar arribo'
            ]);
        }
    }
}

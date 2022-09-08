<?php

namespace App\Console\Commands;

use App\Models\SATIM\PermisoZarpe;
use App\Models\SATIM\ZarpeRevision;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class VerificationZarpeVencido extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verification:zarpevencido';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificacion tiempos de zarpes mayor a 24 horas';

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
        ////// -----    VERIFICACION ZARPE APROBADO O NAVEGANDO CON MAS DE 24 HORAS QUE DEBIO NOTIFICAR ARRIVO -----/////
        $zarpeVencido1=PermisoZarpe::whereRaw('fecha_hora_regreso::TIMESTAMP + \'24 hr\'::INTERVAL <= now()')
            ->where('status_id',1)
            ->update(['status_id'=>7]);
        $zarpeVencido5=PermisoZarpe::whereRaw('fecha_hora_regreso::TIMESTAMP + \'24 hr\'::INTERVAL <= now()')
            ->where('status_id',5)
            ->update(['status_id'=>7]);

        $zarpeR1=PermisoZarpe::select('id')->whereRaw('fecha_hora_regreso::TIMESTAMP + \'24 hr\'::INTERVAL <= now()')
            ->where('status_id',1)
            ->get();
        foreach($zarpeR1 as $record1){
            ZarpeRevision::insert([
                'user_id' => 1,
                'permiso_zarpe_id' => $record1->id,
                'accion'=>'Vencido',
                'motivo'=>'Pasada 24 horas sin notificar arribo'
            ]);
        }
        $zarpeR5=PermisoZarpe::select('id')->whereRaw('fecha_hora_regreso::TIMESTAMP + \'24 hr\'::INTERVAL <= now()')
            ->where('status_id',5)
            ->get();
        foreach($zarpeR5 as $record4){
            ZarpeRevision::insert([
                'user_id' => 1,
                'permiso_zarpe_id' => $record4->id,
                'accion'=>'Vencido',
                'motivo'=>'Pasada 24 horas sin notificar arribo'
            ]);
        }


        Storage::append("archivo.txt",$zarpeVencido1);
    }
}

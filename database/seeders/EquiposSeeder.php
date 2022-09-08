<?php

namespace Database\Seeders;

use App\Models\SATIM\Equipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.equipos')->insert([
            [
                'id'=>1,
                'equipo'=>'CHALECOS SALVAVIDAS',
                'cantidad'=>true,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>2,
                'equipo'=>'SEÑALES PIROTÉCNICAS',
                'cantidad'=>true,
                'otros'=>'colores',
                'created_at'=>now()
            ],
            [
                'id'=>3,
                'equipo'=>'EQUIPO PORTÁTIL CONTRA INCENDIOS',
                'cantidad'=>true,
                'otros'=>'fecha_ultima_inspeccion',
                'created_at'=>now()
            ],
            [
                'id'=>4,
                'equipo'=>'EQUIPO FIJO CONTRA INCENDIO',
                'cantidad'=>false,
                'otros'=>'fecha_ultima_inspeccion',
                'created_at'=>now()
            ],
            [
                'id'=>5,
                'equipo'=>'KIT DE PRIMEROS AUXILIOS',
                'cantidad'=>false,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>6,
                'equipo'=>'COMPAS MAGNÉTICO',
                'cantidad'=>false,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>7,
                'equipo'=>'GPS',
                'cantidad'=>false,
                'otros'=>'tipo',
                'created_at'=>now()
            ],
            [
                'id'=>8,
                'equipo'=>'TELÉFONO SATELITAL',
                'cantidad'=>true,
                'otros'=>'Numero Teléfono',
                'created_at'=>now()
            ],
            [
                'id'=>9,
                'equipo'=>'RADIOBALIZA DE SINIESTRO (EPIRB)',
                'cantidad'=>false,
                'otros'=>'fecha_ultima_inspeccion',
                'created_at'=>now()
            ],
            [
                'id'=>10,
                'equipo'=>'RADAR',
                'cantidad'=>false,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>11,
                'equipo'=>'AIS DEBIDAMENTE CONFIGURADO',
                'cantidad'=>false,
                'otros'=>'MMSI',
                'created_at'=>now()
            ],
            [
                'id'=>12,
                'equipo'=>'VHF FIJO',
                'cantidad'=>false,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>13,
                'equipo'=>'VHF PORTÁTIL',
                'cantidad'=>true,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>14,
                'equipo'=>'BALSA SALVAVIDAS',
                'cantidad'=>true,
                'otros'=>'tipo',
                'created_at'=>now()
            ],
            [
                'id'=>15,
                'equipo'=>'CAJA DE HERRAMIENTAS',
                'cantidad'=>false,
                'otros'=>'ninguno',
                'created_at'=>now()
            ],
            [
                'id'=>16,
                'equipo'=>'SPOT',
                'cantidad'=>false,
                'otros'=>'tipo',
                'created_at'=>now()
            ]

        ]);

    }
}

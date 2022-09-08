<?php

namespace Database\Seeders;

use App\Models\SATIM\CargoTablaMando;
use App\Models\SATIM\TablaMando;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaMandoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /////UAB 0 a 10/////////
        $mando1 = TablaMando::create([
            'UAB_minimo' => '0',
            'UAB_maximo' => '10',
            'cant_tripulantes' => '2',
            'created_at' => now(),
        ]);

         CargoTablaMando::create([
                'cargo_desempena' => 'capitan',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Tercera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando1['id'],
                'created_at'=>now()
        ]);

        CargoTablaMando::create([
                'cargo_desempena' => 'marinero',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Tercera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando1['id'],
                'created_at'=>now()
        ]);

        /////UAB 11 a 39/////////
        $mando2 = TablaMando::create([
            'UAB_minimo' => '11',
            'UAB_maximo' => '39',
            'cant_tripulantes' => '2',
            'created_at' => now(),
        ]);

        CargoTablaMando::create([
                'cargo_desempena' => 'capitan',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Segunda',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando2['id'],
                'created_at'=>now()
           ]);

        CargoTablaMando::create([
                'cargo_desempena' => 'marinero',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Tercera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando2['id'],
                'created_at'=>now()
           ]);

        /////UAB 40 a 150/////////
        $mando3 = TablaMando::create([
            'UAB_minimo' => '40',
            'UAB_maximo' => '150',
            'cant_tripulantes' => '3',
            'created_at' => now(),
        ]);

        CargoTablaMando::create([
                'cargo_desempena' => 'capitan',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Primera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando3['id'],
                'created_at'=>now()
          ]);
        CargoTablaMando::create([
                'cargo_desempena' => 'motorista',
                'titulacion_aceptada_minima' =>'Motorista de Segunda',
                'titulacion_aceptada_maxima' =>'Motorista de Primera',
                'tabla_mando_id' => $mando3['id'],
                'created_at'=>now()
          ]);
        CargoTablaMando::create([
                'cargo_desempena' => 'marinero',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Tercera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando3['id'],
                'created_at'=>now()
           ]);

        /////UAB mayor a 150/////////
        $mando4 = TablaMando::create([
            'UAB_minimo' => '150',
            'UAB_maximo' => '500',
            'cant_tripulantes' => '4',
            'created_at' => now(),
        ]);

        CargoTablaMando::create([
                'cargo_desempena' => 'capitan',
                'titulacion_aceptada_minima' =>'Capitán de Yate',
                'titulacion_aceptada_maxima' =>'Capitán de Yate',
                'tabla_mando_id' => $mando4['id'],
                'created_at'=>now()
            ]);
        CargoTablaMando::create([
                'cargo_desempena' => 'motorista',
                'titulacion_aceptada_minima' =>'Motorista de Primera',
                'titulacion_aceptada_maxima' =>'Motorista de Primera',
                'tabla_mando_id' => $mando4['id'],
                'created_at'=>now()
           ]);
        CargoTablaMando::create([
                'cargo_desempena' => 'marinero',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Tercera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando4['id'],
                'created_at'=>now()
          ]);
        CargoTablaMando::create([
                'cargo_desempena' => 'marinero',
                'titulacion_aceptada_minima' =>'Patrón Deportivo de Tercera',
                'titulacion_aceptada_maxima' =>'Patrón Deportivo de Primera',
                'tabla_mando_id' => $mando4['id'],
                'created_at'=>now()
           ]);

    }
}

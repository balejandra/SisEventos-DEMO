<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusZarpes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.status')->insert([
            [
                'id'=>1,
                'nombre'=>'Aprobado',
                'created_at'=>now()
            ],
            [
                'id'=>2,
                'nombre'=>'Rechazado',
                'created_at'=>now()
            ],
            [
                'id'=>3,
                'nombre'=>'Pendiente',
                'created_at'=>now()
            ],
            [
                'id'=>4,
                'nombre'=>'Cerrado',
                'created_at'=>now()
            ],
            [
                'id'=>5,
                'nombre'=>'Navegando',
                'created_at'=>now()
            ],
            [
                'id'=>6,
                'nombre'=>'Anulado',
                'created_at'=>now()
            ],
            [
                'id'=>7,
                'nombre'=>'Anulado Vencido',
                'created_at'=>now()
            ],
            [
                'id'=>8,
                'nombre'=>'Anulado SAR',
                'created_at'=>now()
            ],
            [
                'id'=>9,
                'nombre'=>'Visita asignada',
                'created_at'=>now()
            ],
            [
                'id'=>10,
                'nombre'=>'Visita aprobada, recaudos faltantes',
                'created_at'=>now()
            ],
            [
                'id'=>11,
                'nombre'=>'Pendiente Aprobacion',
                'created_at'=>now()
            ],
            [
                'id'=>12,
                'nombre'=>'Renovacion',
                'created_at'=>now()
            ],
        ]);
    }
}

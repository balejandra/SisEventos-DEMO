<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
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
                'nombre'=>'Pagado',
                'created_at'=>now()
            ],
            [
                'id'=>5,
                'nombre'=>'Pago Rechazado',
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
        ]);
    }
}

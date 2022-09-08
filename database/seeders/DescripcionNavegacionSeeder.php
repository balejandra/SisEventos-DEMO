<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DescripcionNavegacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('zarpes.descripcion_navegacion')->insert([
            [
                'id'=>1,
                'descripcion'=>'Dentro de una circunscripción',
                'created_at'=>now()
            ],
            [
                'id'=>2,
                'descripcion'=>'Dentro de una circunscripción pero hacia una dependencia federal',
                'created_at'=>now()
            ],
            [
                'id'=>3,
                'descripcion'=>'Entre circunscripciones',
                'created_at'=>now()
            ],
            [
                'id'=>4,
                'descripcion'=>'Internacional',
                'created_at'=>now()
            ],
             
        ]);

         
    }
}

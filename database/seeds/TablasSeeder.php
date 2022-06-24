<?php

use Illuminate\Database\Seeder;
use App\Tablas;

class TablasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = json_decode(file_get_contents(__DIR__ . '/json/tablas.json'));
        foreach ($data as $item){
            Tablas::create(array(
                //'id' => $item->IdRol,
                'detalle' => $item->detalle,
                'tabla' => $item->tabla,
                'pregunta' => $item->pregunta,
               
            ));
            }
    }
}

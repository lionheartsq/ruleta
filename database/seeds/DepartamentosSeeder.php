<?php

use Illuminate\Database\Seeder;
use App\Departamento;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = json_decode(file_get_contents(__DIR__ . '/json/departamentos.json'));
        foreach ($data as $item){
            Departamento::create(array(
                //'id' => $item->IdRol,
                'detalle' => $item->detalle
                // 'idDepartamento' => $item->idDepartamento,

            ));
            }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'departamento'
        ]);

        //funcion principal que llama cada seeder
        $this->call(DepartamentosSeeder::class);
//-------------------------------------------------------------------//
        // $this->call(UsersTableSeeder::class);
        $this->truncateTables([
            'baile'
        ]);

        //funcion principal que llama cada seeder
        $this->call(BaileSeeder::class);
//-------------------------------------------------------------------//
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'capital'
        ]);

        //funcion principal que llama cada seeder
        $this->call(CapitalSeeder::class);
//-------------------------------------------------------------------//
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'clima'
        ]);

        //funcion principal que llama cada seeder
        $this->call(ClimaSeeder::class);
//-------------------------------------------------------------------//
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'comida'
        ]);

        //funcion principal que llama cada seeder
        $this->call(ComidaSeeder::class);
//-------------------------------------------------------------------//
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'departamento'
        ]);

        //funcion principal que llama cada seeder
        $this->call(DepartamentosSeeder::class);
//-------------------------------------------------------------------//
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'economia'
        ]);

        //funcion principal que llama cada seeder
        $this->call(EconomiaSeeder::class);
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'hidrografia'
        ]);

        //funcion principal que llama cada seeder
        $this->call(HidrografiaSeeder::class);
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'relieve'
        ]);

        //funcion principal que llama cada seeder
        $this->call(RelieveSeeder::class);
//-------------------------------------------------------------------//
        //primero vacia la tabla y luego la llena ojo
        $this->truncateTables([
            'tablas'
        ]);

        //funcion principal que llama cada seeder
        $this->call(TablasSeeder::class);
//-------------------------------------------------------------------//



       
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

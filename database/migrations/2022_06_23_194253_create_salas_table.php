<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salas', function (Blueprint $table) {
            $table->id();
            $table->integer('capacidadSala')->unsigned();
            $table->integer('tipoJuego')->unsigned();
            $table->integer('nPuntaje')->unsigned();
            $table->integer('nTurnos')->unsigned();
            $table->integer('idMod')->unsigned();
            $table->integer('estado')->default(1);
            $table->string('urlRandom');
            
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalladosalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalladosalas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idSala')->constrained('salas');
            $table->foreignId('idJugador')->constrained('jugador');
            $table->integer('turno')->unsigned();
            $table->integer('puntaje')->unsigned();
            

        });
    }
//'>foreignId('idProducto')->constrained('tb_producto');
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalladosalas');
    }
}

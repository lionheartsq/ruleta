<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salas extends Model
{
    //
    protected $table = 'salas';

    protected $fillable = ['capacidad_sala','tipo_juego','n_puntaje','n_turnos'];

    public $timestamps = false;
}

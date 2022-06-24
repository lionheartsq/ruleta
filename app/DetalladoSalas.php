<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalladoSalas extends Model
{
    //
    protected $table = 'detalladoSalas';

    protected $fillable = ['idSala','idJugador','turno','puntaje'];
   
    public $timestamps = false;
}

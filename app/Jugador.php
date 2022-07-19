<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    //
    protected $table = 'jugador';

    protected $fillable = ['nombreUsuario','estado'];
   
    public $timestamps = false;
}

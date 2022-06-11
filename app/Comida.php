<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comida extends Model
{
    //
    protected $table = 'comida';

    protected $fillable = ['detalle','idDepartamento'];

    public $timestamps = false;
}

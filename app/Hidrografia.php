<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hidrografia extends Model
{
    //
    protected $table = 'hidrografia';

    protected $fillable = ['detalle','idDepartamento'];

    public $timestamps = false;
}

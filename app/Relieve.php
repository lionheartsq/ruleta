<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relieve extends Model
{
    //
    protected $table = 'relieve';

    protected $fillable = ['detalle','idDepartamento'];

    public $timestamps = false;
}

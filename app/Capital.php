<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capital extends Model
{
    //
    protected $table = 'capital';

    protected $fillable = ['detalle','idDepartamento'];

    public $timestamps = false;
}

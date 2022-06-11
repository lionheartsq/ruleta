<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Economia extends Model
{
    //
    protected $table = 'economia';

    protected $fillable = ['detalle','idDepartamento'];

    public $timestamps = false;
}

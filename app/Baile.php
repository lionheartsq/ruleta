<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baile extends Model
{
    //
    protected $table = 'baile';

    protected $fillable = ['detalle','idDepartamento'];

    public $timestamps = false;
}

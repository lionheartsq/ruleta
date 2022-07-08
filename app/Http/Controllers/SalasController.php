<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salas;
use App\detalladoSalas;

class SalasController extends Controller
{
    public function crearsalas(Request $request)
    {
        //Debe crear la string random y añadir el id jugador como mod
    
        // if(!$request->ajax()) return redirect('/');
        $randString=substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,10);

        $Salas = new Salas();
        $Salas->capacidadSala=$request->capacidadSala;
        $Salas->tipoJuego=$request->tipoJuego;
        $Salas->nPuntaje=$request->nPuntaje;
        $Salas->nTurnos=$request->nTurnos;
        // $Salas->urlRandom="Prueba";        
        $Salas->urlRandom=$randString;
        // $Salas->urlRandom=substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,10);
        $Salas->estado=1;
        $Salas->save();

        $respuesta= "Registro correcto";
        return ['respuesta' => $respuesta];
        //posterior debe crear el registro en detalladosalas con los datos de la persona que creo (mod) como jugador

    }

    public function editarsalas(Request $request)
    {
        //Debe validar el cambio de estado
        

        if(!$request->ajax()) return redirect('/');
        $Salas = Salas::findOrFail($request->id);
        $Salas->estado=($request->estado)+1;
        $Salas->save();
    }

    public function validarsalas(Request $request){
/* 
        //aca verifica que la sala este cumpliendo con el parametro, si llega al tope se cierra
        $capacidad= Salas::findOrFail($request->id)->get();

        if(capacidadSala+1<$capacidad){
            $Salas->estado=1;
        }
        if($capacidad==capacidadSala.value){
            $Salas->estado=2; 
        }
        if($capacidad==capacidadSala.value && nTurnos.value()==turnos.value() && nPuntaje.value()==puntos.value()){
            $Salas->estado=3;
        }
        $Salas= new Salas();
        $Salas->capacidadSala=$request->capacidadSala;
        
        //$respuesta = Salas::orderBy('id','asc')->get();
        $respuesta = "blablabla";

        //return ['respuesta' => $respuesta]; */
        }


    public function infosalas(){
        //desde aca puede validar el estado de los turnos (historico)

            $respuesta = Salas::orderBy('id','asc')->get();
    
            return ['respuesta' => $respuesta];
        }        

}

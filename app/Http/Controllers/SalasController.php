<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salas;

class SalasController extends Controller
{
    public function validar(Request $request)
    {   $tipo_juego=$request->tipo_juego;
        if()

        //
        if(!$request->ajax()) return redirect('/');
        $Salas = new Salas();
        $Salas->capacidad_sala=$request->capacidad_sala;
        $Salas->tipo_juego=$request->tipo_juego;
        $Salas->n_puntaje=$request->n_puntaje;
        $Salas->n_turnos=$request->n_turnos;
        $Salas->estado=$request->estado;
        $Salas->save();

    }

    public function store(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $Salas = new Salas();
        $Salas->capacidad_sala=$request->capacidad_sala;
        $Salas->tipo_juego=$request->tipo_juego;
        $Salas->n_puntaje=$request->n_puntaje;
        $Salas->n_turnos=$request->n_turnos;
        $Salas->estado=$request->estado;
        $Salas->save();

    }

    public function update(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $Salas = Salas::findOrFail($request->id);
        $Salas->capacidad_sala=$request->capacidad_sala;
        $Salas->tipo_juego=$request->tipo_juego;
        $Salas->n_puntaje=$request->n_puntaje;
        $Salas->n_turnos=$request->n_turnos;
        $Salas->estado='1';
        $Salas->save();
    }

    public function crearSala()
    {
        $Salas = Salas::where('tipo_juego','=','1')
        ->select('id as idProceso','proceso')->orderBy('proceso','asc')->get();

        return ['procesos' => $Salas];
    }

    public function selectTipoJuego()
    {
        $Salas = Salas::where('tipo_juego','=','1')
        ->select('id as idProceso','proceso')->orderBy('proceso','asc')->get();

        return ['procesos' => $Salas];
    }

    public function indexSalas(){
        $respuesta = Salas::orderBy('id','asc')->get();

        return ['respuesta' => $respuesta];
        }

    public function infoSalas(Request $request)
    {
        $flag=$request->id;

        $respuesta = Salas::where('id', '=', $flag)->orderBy('id','asc')->get();

        if($respuesta->isNotEmpty()){
            return ['respuesta' => $respuesta];
        }
        else{
            $respuesta="No existen registros con este número";
            return ['respuesta' => $respuesta];
        }
    }

}

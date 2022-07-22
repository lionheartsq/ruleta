<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salas;
use App\DetalladoSalas;
use Illuminate\Support\Facades\DB;
use App\Jugador;

class SalasController extends Controller
{
    public function crearsalas(Request $request)
    {
        //Debe crear la string random y añadir el id jugador como mod
        // /salas/crear?capacidadSala=5&tipoJuego=1&nPuntaje=1000&nTurnos=10&urlRandom=prueba&idJugador=1

        // if(!$request->ajax()) return redirect('/');
        $randString=substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,10);

        $Sala=new Salas();
        $Sala->capacidadSala=$request->capacidadSala;
        $Sala->tipoJuego=$request->tipoJuego;
        $Sala->nPuntaje=$request->nPuntaje;
        $Sala->nTurnos=$request->nTurnos;
        $Sala->urlRandom=$randString;
        $Sala->idMod=$request->idJugador;
        $Sala->estado=1;
        $Sala->save();

        //posterior debe crear el registro en detalladosalas con los datos de la persona que creo (mod) como jugador

        $detalladosalas = new DetalladoSalas();
        $idSala = $Sala->id;
        $puntaje=0;
        $turno=0;

        $detalladosalas->idJugador=$request->idJugador;
        $detalladosalas->idSala=$idSala;
        $detalladosalas->turno=$turno;
        $detalladosalas->puntaje=$puntaje;
        $detalladosalas->save();

        $Jugador=Jugador::findOrFail($request->idJugador);
        $Jugador->estado='2';
        $Jugador->save();

        $respuesta="Ok";

        return ['respuesta' => $respuesta];

    }

    public function ingresarsalas(Request $request)
    {
        // /salas/ingresar?stringsala=85UIQN0RKB&idJugador=1

        $flag=0;
        $stringsala=$request->id;
        $idJugador=$request->idJugador;

        // /salas/ingresar?id=85UIQN0RKB&idJugador=1
        //con este busco en salas cual lo tiene como string y que esté en espera, de ahi me traigo el idsala

        $respuesta = Salas::where('estado', '=', '1')
        ->where('urlRandom', '=', $stringsala)
        ->orderBy('id','asc')->get();

        $cantidad=$respuesta->count();

        if($cantidad>0){
            foreach($respuesta as $guia){ //apertura foreach nomina
                $idSala = $guia->id;
                $capacidadSala = $guia->capacidadSala;
                }
                
            $validadorIngreso= DetalladoSalas::where('idJugador','=',$idJugador)
            ->where ('idSala', '=', $idSala)
            ->count();

            if($validadorIngreso>0){
                echo "El jugador ya está registrado; existe : ".$validadorIngreso." veces";
                $flag=0;
            } 
            else{
                $flag=1;
            }   
        }
        else{
            $flag=0;
        }

        if($flag==1){
            //mysql peticion
            $cantusuarios = Salas::join('detalladosalas','salas.id','=','detalladosalas.idSala')
            ->where('detalladosalas.idSala','=', $idSala)
            ->count();

            if($capacidadSala > $cantusuarios){

              $detalladosalas = new DetalladoSalas();

                $puntaje=0;
                $turno=0;

                $detalladosalas->idJugador=$idJugador;
                $detalladosalas->idSala=$idSala;
                $detalladosalas->turno=$turno;
                $detalladosalas->puntaje=$puntaje;
                $detalladosalas->save();

                $Jugador=Jugador::findOrFail($idJugador);
                $Jugador->estado='2';
                $Jugador->save();

                if($capacidadSala==($cantusuarios+1)){
                    $Salas=Salas::findOrFail($idSala);
                    $cantSalas=$Salas->count();
                    $Salas->estado='2';
                    $Salas->save();
                    //cambio estado de la sala y salgo
                    $respuesta="Ultimo Usuario ingresa con éxito, cantidad de usuarios sala: ".$idSala." es: ".$cantusuarios." debo cerrar la sala; conteo de registros de sala: ".$cantSalas;
                }
                else{
                    //solo salgo
                    $respuesta="Usuario ingresa con éxito, la cantidad de usuarios registrados antes en la sala ".$idSala." es: ".$cantusuarios;
                }
            }
            else {
                //
                $respuesta="La sala está llena";
            }
        }
        else{
            $respuesta="La sala no está disponible";
        }

        //validaciones: si excede los usuarios hay tabla. si la sala esta activa hay tabla. si la sala esta cerrada madrugue.

        return ['respuesta' => $respuesta]; /**/

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
        

        //aca verifica que la sala este cumpliendo con el parametro, si llega al tope se cierra
       
        }


    public function infosalas(Request $request){
        //desde aca puede validar el estado de los turnos (historico)
        $turnos=$request->nTurnos;
        $idJugador=$request->idJugador;
        $idSala=$request->idSala;
        $turno=$request->turno;

        //Con esta consulta me traigo la sala 
        $salaenjuego = Salas::where('estado', '=', 2)
        ->where('id','=', $idSala)
        ->select('id')
        ->get();
        
        //con esta consulta traigo el tope de turnos 
        $turnos= Salas::where('id','=',$salaenjuego)
        ->select('salas.nTurnos')
        ->get();

        // return $turnos; BIEN
        // return $salaenjuego; BIEN  

        //con esta consulta traigo el turno 
        $turno= DetalladoSalas::where('detalladosalas.idSala','=',$salaenjuego)
        // ->where('detalladosalas.idJugador','=',$idJugador)
        ->select('turno')
        ->get();

        // return $turno; BIEN 

        //con esta consulta traigo el puntaje maximo
        $puntaje=DetalladoSalas::where('detalladosalas.idSala','=', $salaenjuego)
        // ->where('detalladosalas.idSala','=', $salaenjuego)
        ->select(DB::RAW('max(detalladosalas.puntaje)as maximo'))
        ->get();

       
        //con esta consulta traigo el nombre del jugador que gane la partida
        $ganador=Jugador::join('detalladosalas','jugador.id','=','detalladosalas.idJugador')
        ->where('detalladosalas.turno','=', $turnos)
        ->where('detalladosalas.idSala','=', $salaenjuego)
        ->where('detalladosalas.puntaje','=',$puntaje)
        ->select('jugador.nombreUsuario')
        ->get();

        return $ganador;

        

        // if($turnos=$turno){

        //    return "El ganador del juego es".$ganador."con un puntaje de".$puntaje;
           
        //    $Sala=Salas::findOrFail($request->idSala);
        //    $Sala->estado='3';
        //    $Sala->save();

        // }
        // else
        // {
        //     echo "nadie gana aun";
        // }
        // $ganador=DetalladoSalas::join('salas','detalladosalas.idSala','=',$salaenjuego)
        // ->select('detalladosalas.idJugador','detalladosalas.idSala','detalladosalas.turno', 'salas.nTurnos')
        // ->where('detalladosalas.idJugador','=', $idJugador)
        // ->where('salas.nTurnos','=', $turnos)
        // ->get();


        

            // $respuesta = Salas::orderBy('id','asc')->get();

            // return ['respuesta' => $respuesta];
        }

}

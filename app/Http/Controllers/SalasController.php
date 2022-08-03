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

                $idSala=$request->idSala;
                $turnos="";
                $idJugador="";
                $turnojugador="";
                $estado="";

                //Con esta consulta me traigo la sala
                $salaenjuego = Salas::where('id','=', $idSala)
                ->select('estado','tipoJuego','nTurnos','nPuntaje','capacidadSala')
                ->get();

                foreach($salaenjuego as $asig){
                    $estado = $asig->estado;
                    $tipoJuego = $asig->tipoJuego;
                    $nTurnos1 = $asig->nTurnos;
                    $nPuntaje = $asig->nPuntaje;
                    $capacidadSala1 = $asig->capacidadSala;
                }

                if($estado == '2'){

                    // return "entro por estado 2".$estado;
                    //totumado de operaciones
                    // return "entro al if";
                    //  con esta consulta traigo el tope de turnos
 
                    $nTurnos= Salas::where('id','=',$idSala)
                    ->select('salas.nTurnos')
                    ->get();

                    // return $nTurnos;

                    // con esta consulta traigo el turno
                    $turnojugador= DetalladoSalas::where('detalladosalas.idSala','=',$idSala)
                    // ->where('detalladosalas.idJugador','=',$idJugador)
                    ->select('detalladosalas.turno')
                    ->get();

                    // return $turnojugador;

                    // // //con esta consulta traigo el puntaje maximo
                    $puntaje=DetalladoSalas::where('detalladosalas.idSala','=', $idSala)
                    // ->where('detalladosalas.idSala','=', $salaenjuego)--- esta no se descomenta
                    ->select(DB::RAW('max(detalladosalas.puntaje)as maximo'))
                    ->get();
                     // return $puntaje; FUNCIONA

                     $puntajehistorico = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id')
                     ->where('detalladosalas.idSala','=',$idSala)
                    //  ->where('detalladosalas.puntaje','>',$puntaje)
                     ->select('jugador.nombreUsuario','detalladosalas.puntaje')
                     ->orderBy('puntaje','desc')
                     ->get();

                     $turnoshistorico = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id') //este lo puede traer y de hecho deberia en la linea anterior
                     ->where('detalladosalas.idSala','=',$idSala)
                    //  ->where('detalladosalas.puntaje','>',$puntaje)
                     ->select('jugador.nombreUsuario','detalladosalas.turno','detalladosalas.puntaje')
                     ->orderBy('puntaje','desc')
                     ->get();

                    //  return ['puntaje actual'=> $turnoshistorico];

                    $puntajen=DetalladoSalas::where('detalladosalas.idSala','=', $idSala)
                    ->where('detalladosalas.idJugador','=', $idJugador)
                    ->select('detalladosalas.puntaje')
                    ->get();

                    // return $puntajen;

                    // // con esta consulta sumo los turnos de los jugadores que hay en sala
                    $sumaturnos= DetalladoSalas::where('detalladosalas.idSala','=', $idSala)
                    ->select(DB::RAW('sum(detalladosalas.turno)as sumaturnos'))
                    ->get();

                    foreach($sumaturnos as $asig){
                        $sumaturnos1 = $asig->sumaturnos;
                        }

                    
                    $ganador = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id') //este solo deberia usarlo cuando la sala llega a la necesidad de cerrarse
                    ->where('detalladosalas.idSala','=',$idSala)
                    ->where('detalladosalas.puntaje','>',$puntaje)
                    ->select('jugador.nombreUsuario')
                    ->get();

                    foreach($ganador as $asig){
                        $ganadorf = $asig->nombreUsuario;
                        }

                    $actualizaestado = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id')
                    ->where('detalladosalas.idSala','=',$idSala)
                    // ->where('detalladosalas.puntaje','>',$puntaje)
                    ->select('jugador.id')
                    ->get();

                        
                    foreach($actualizaestado as $asig){
                        $actualizaestado1 = $asig->id;
                        
                        }
                        $array=['jugadores'=>$actualizaestado1];
                        

                    foreach($puntaje as $asig){
                        $puntaje1 = $asig->maximo;
                        $turnojugador= $asig->turno;
                        $sumaturnos=$asig->turno;
                        }
                    // return $idganador;

                    //de hecho hay muchas cosas que deberia estar haciendo al entrar acá y no afuera

                    if($tipoJuego == '1'){
                        //miro si alguno ya llegó a los puntos
                        // return "entro al if tipojuego 1";
                        // return "entro al primer if, tipo juego 1";
                        if($nPuntaje <= $puntaje1){
                        
                            $jugadoresensala = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id') //este solo deberia usarlo cuando la sala llega a la necesidad de cerrarse
                            ->where('detalladosalas.idSala','=',$idSala)
                            ->select('jugador.id','jugador.nombreUsuario','jugador.estado')
                            ->get();
            
                            foreach($jugadoresensala as $jugador){
                            $id = $jugador->id;
                            $nombreUsuario= $jugador->nombreUsuario;
                            $estado= $jugador->estado;
            
                            echo $id;
                            echo "<br>";
                            echo $nombreUsuario;
                            echo "<br>";
                            echo $estado;
                            echo "<hr>";    
            
                            $Jugador=Jugador::findOrFail($id);
                            $Jugador->estado='2';
                            $Jugador->save();
                            }    

                            $Sala=Salas::findOrFail($idSala);
                            $Sala->estado='3';
                            $Sala->save();
     

                        //aqui inicio cambios

                        // return "el ganador del juego es ".$ganadorf." con un puntaje de ".$puntaje1." puntos";

                        }
                        else
                        {
                            return ['puntaje actual'=> $puntajehistorico];
                        }

                    }
                    else if($tipoJuego == '2'){
                        //miro si TODOS ya llegaron a los turnos y valido quien tiene mas puntos
                        // return "entro al segundo if, tipo juego 2";
                        //se declara el fin del juego cuando la suma de turnos de todos los jugadores sea
                        // igual a los turnos por jugador multiplicados por la cantidad de jugadores
                        $topefin=0;
                        $topefin = $nTurnos1 * $capacidadSala1;
                        
                        if ($sumaturnos1==$topefin){

                            $jugadoresensala = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id') //este solo deberia usarlo cuando la sala llega a la necesidad de cerrarse
                            ->where('detalladosalas.idSala','=',$idSala)
                            ->select('jugador.id','jugador.nombreUsuario','jugador.estado')
                            ->get();
            
                            foreach($jugadoresensala as $jugador){
                            $id = $jugador->id;
                            $nombreUsuario= $jugador->nombreUsuario;
                            $estado= $jugador->estado;
            
                            echo $id;
                            echo "<br>";
                            echo $nombreUsuario;
                            echo "<br>";
                            echo $estado;
                            echo "<hr>";    
            
                            $Jugador=Jugador::findOrFail($id);
                            $Jugador->estado='2';
                            $Jugador->save();
                            }    

                            $Sala=Salas::findOrFail($idSala);
                            $Sala->estado='3';
                            $Sala->save();
     
                        // return "el ganador del juego es ".$ganadorf." con un puntaje de ".$puntaje1." puntos";

                    }
                    else
                    {
                        return ['historial de turnos'=> $turnoshistorico];
                    }

                    }
                }

                else{
                    // return "entre al ultimo else";
                    //cerre la sala y muestro el ganador
                    if($estado == '3')
                    {

                    $turnoshistorico = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id') //este lo puede traer y de hecho deberia en la linea anterior
                    ->where('detalladosalas.idSala','=',$idSala)
                    //  ->where('detalladosalas.puntaje','>',$puntaje)
                    ->select('jugador.nombreUsuario','detalladosalas.turno','detalladosalas.puntaje')
                    ->orderBy('puntaje','desc')
                    ->get();
                    // return ['Puntaje final'=> $turnoshistorico];
                    // echo "el ganador del juego es ".$ganadorf." con un puntaje de ".$puntaje1." puntos";
                    return ['Puntaje final'=> $turnoshistorico];
                    // "el ganador del juego es ".$ganadorf." con un puntaje de ".$puntaje1." puntos";

                    }
 
                }

            }
        
            public function infosalas(Request $request){
            //desde aca puede validar el estado de los turnos (historico)
            $idSala=$request->idSala;

            $respuesta = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id')
            ->where('idSala','=',$idSala)
            ->select('turno','puntaje','nombreUsuario')
            ->orderBy('detalladosalas.id','asc')
            ->get();

            return ['respuesta' => $respuesta];
        }

        public function prueba(){
                 $jugadoresensala = DetalladoSalas::join('jugador','detalladosalas.idJugador','=','jugador.id') //este solo deberia usarlo cuando la sala llega a la necesidad de cerrarse
                ->where('detalladosalas.idSala','=','1')
                ->select('jugador.id','jugador.nombreUsuario','jugador.estado')
                ->get();

                //$jugadoresensala = Jugador::select('jugador.id')->count();

                //echo $jugadoresensala;
/* */
            foreach($jugadoresensala as $jugador){
                $id = $jugador->id;
                $nombreUsuario= $jugador->nombreUsuario;
                $estado= $jugador->estado;

                echo $id;
                echo "<br>";
                echo $nombreUsuario;
                echo "<br>";
                echo $estado;
                echo "<hr>";    

                $Jugador=Jugador::findOrFail($id);
                $Jugador->estado='2';
                $Jugador->save();
                }    
        }        

}
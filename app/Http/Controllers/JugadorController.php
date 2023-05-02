<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jugador;

use App\Http\Controllers\SalasController;


class JugadorController extends Controller
{


    public function validarjugador(Request $request)
    {
        ///jugador/validar?nombreUsuario=farina
        $nombreUsuario=$request->nombreUsuario;
        // SELECT count(*) FROM `detalladosalas` WHERE idSala in (SELECT id FROM `salas` WHERE estado not in ('3'))
        // and idJugador='17';

        //estados jugador: 1 libre, 2 ocupado

        $creados=Jugador::where('nombreUsuario','=',$nombreUsuario)
        ->count();

        if($creados>0){
            //aca miro si estan activos

            $estados=Jugador::where('nombreUsuario','=',$nombreUsuario)
            ->where('estado','=','1')
            ->count();

            if($estados>0){

                //echo "Disponible";
                $mensaje="Disponible";
                $idJugadorSelect= Jugador::select('id')->where('nombreUsuario','=',$nombreUsuario)->where('estado','=','1')->get();

                foreach($idJugadorSelect as $select){ //apertura foreach nomina
                    $idJugador = $select->id;
                }
            }
            else{
                //echo "Ocupado";
                $mensaje="Ocupado";
                $idJugador=0;
            }
        }
        else{
            //creo el usuario

            //echo "Debo crear el usuario";
            $Jugador=new Jugador();
            $Jugador->nombreUsuario=$request->nombreUsuario;
            $Jugador->estado='1';
            $Jugador->save();
            $idJugador= $Jugador->id;
            $mensaje="Nuevo";
        }

        //echo $creados;
        return [
            'code' => $mensaje,
            'idJugador' => $idJugador
            ];
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function crearTorneo(Request $request) {
        //Creamos el torneo con los datos recibidos de cada jugador
        $torneo = Torneo::create($request->only(['nombre', 'genero']));

        //Recorremos cada jugador y lo asociamos al torneo
        foreach ($request->jugadores as $jugadorInfo) {
            $jugador = Jugador::create($jugadorInfo);
            $torneo->jugadores()->attach($jugador);
        }

        //Simulamos el torneo
        $ganador = $torneo->simularTorneo();


        //Devolvemos el ganador con un status 200
        return response()->json(['ganador' => $ganador->nombre_apellido]);
    }
}

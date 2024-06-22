<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;

    protected $filleable = [
        'nombre',
        'genero',
    ];

    public function jugadores() {
        return $this->belongsToMany(Jugador::class);
    }

    public function partidos() {
        return $this->hasMany(Partido::class);
    }

    public function simularTorneo() {
        $jugadores = $this->jugadores()->get();
        $ronda = 1;

        while ($jugadores->count() > 1) {
            $jugadores = $this->ronda($jugadores, $ronda);
            $ronda++;
        }

        return $jugadores->first();
    }

    protected function ronda($jugadores, $ronda) {
        //Instanciamos una coleccion para los ganadores
        $ganadores = collect();

        //Recorremos los jugadores de a pares y generamos el partido
        for($i = 0; $i < $jugadores->count(); $i += 2) {
            $jugador1 = $jugadores[$i];
            $jugador2 = $jugadores[$i +1];

            $partido = new Partido([
               'jugador1_id' => $jugador1->id,
               'jugador2_id' => $jugador2->id,
               'ganador_id' => $this->elegirGanador($jugador1, $jugador2)->id,
            ]);

            //Guardamos el partido en la bdd
            $partido->save();

            //Agrego el ganador a la coleccion de ganadores
            $ganadores->push($partido->ganador);
        }
    }

    protected function elegirGanador($jugador1, $jugador2) {
        //Probabilidades por jugador
        $probabilidad_jugador_1 = $jugador1->nivel_habilidad;
        $probabilidad_jugador_2 = $jugador2->nivel_habilidad;

        //Considero factores de genero
        switch ($jugador1 && $jugador2){
            case $jugador1->genero == 'masculino' && $jugador2->genero == 'masculino':
                $probabilidad_jugador_1 += $jugador1->fuerza + $jugador1->velocidad;
                $probabilidad_jugador_2 += $jugador2->fuerza + $jugador2->velocidad;
            break;

            case $jugador1->genero == 'femenino' && $jugador2->genero == 'femenino':
                $probabilidad_jugador_1 += $jugador1->reaccion;
                $probabilidad_jugador_2 += $jugador2->reaccion;
            break;

            case $jugador1->genero == 'masculino' && $jugador2->genero == 'femenino':
                $probabilidad_jugador_1 += $jugador1->fuerza + $jugador1->velocidad;
                $probabilidad_jugador_2 += $jugador2->reaccion;
            break;

            case $jugador1->genero == 'femenino' && $jugador2->genero == 'masculino':
                $probabilidad_jugador_1 += $jugador1->reaccion;
                $probabilidad_jugador_2 += $jugador2->fuerza + $jugador2->velocidad;
            break;
        }

        //Simulamos la suerte
        $suerte_jugador_1 = rand(0, 29);
        $suerte_jugador_2 = rand(0, 29);

        $probabilidad_jugador_1 += $suerte_jugador_1;
        $probabilidad_jugador_2 += $suerte_jugador_2;

        return $probabilidad_jugador_1 > $probabilidad_jugador_2 ? $jugador1 : $jugador2;
    }
}

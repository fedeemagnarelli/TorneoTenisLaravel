<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_apellido',
        'nivel_habilidad',
        'genero',
        'fuerza',
        'velocidad',
        'reaccion',
    ];

    public function isMasculino() {
        return $this->genero === 'masculino';
    }

    public function isFemenino() {
        return $this->genero === 'femenino';
    }
}

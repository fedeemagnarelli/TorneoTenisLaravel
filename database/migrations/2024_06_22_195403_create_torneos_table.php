<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido');
            $table->string('genero', ['masculino', 'femenino']);
            $table->timestamps();
        });

        Schema::create('torneos_jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torneo_id')->constrained('torneos');
            $table->foreignId('jugador_id')->constrained('jugadores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos_jugadores');
        Schema::dropIfExists('torneos');
    }
};

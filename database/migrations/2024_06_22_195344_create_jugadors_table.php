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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_apellido', 100)->nullable(false);
            $table->integer('nivel_habilidad', 20)->nullable(false);
            $table->string('genero', ['masculino', 'femenino'])->nullable(false);
            $table->integer('fuerza')->nullable();
            $table->integer('velocidad')->nullable();
            $table->integer('reaccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadors');
    }
};

<?php

use App\Http\Controllers\TorneoController;
use Illuminate\Support\Facades\Route;

Route::post('/torneos', [TorneoController::class, 'crearTorneo']);
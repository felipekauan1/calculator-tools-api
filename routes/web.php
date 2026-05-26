<?php

use App\Http\Controllers\CalculadoraController;
use Illuminate\Support\Facades\Route;

Route::get('/calculadoras', [CalculadoraController::class, 'index']);
Route::get('/calculadoras/{tipo}', [CalculadoraController::class, 'show']);
Route::post('/calculadoras/{tipo}', [CalculadoraController::class, 'store']);

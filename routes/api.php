<?php

use App\Http\Controllers\Api\CalculadoraApiController;
use Illuminate\Support\Facades\Route;

Route::get('/calculadoras', [CalculadoraApiController::class, 'index']);
Route::post('/calculadoras/{tipo}', [CalculadoraApiController::class, 'store']);

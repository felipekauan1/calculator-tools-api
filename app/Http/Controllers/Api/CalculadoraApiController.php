<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calculo;
use App\Services\CalculadoraService;

class CalculadoraApiController extends Controller
{
    protected $service;

    public function __construct(CalculadoraService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json([
            'sucesso' => true,
            'tipos' => $this->service::TIPOS,
        ]);
    }

    public function store(string $tipo, Request $request)
    {
        if (!in_array($tipo, $this->service::TIPOS)) {
            abort(404);
        }

        $dados = $request->validate($this->service->regras($tipo));

        Calculo::create([
            'tipo' => $tipo,
        ]);

        return response()->json([
            'sucesso' => true,
            'dados' => $dados,
            'resultado' => $this->service->calcular($tipo, $dados),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculo;
use App\Services\CalculadoraService;

class CalculadoraController extends Controller
{
    protected $service;

    const TIPOS = [
            'regra_tres_simples',
            'resto_da_divisao',
            'porcentagem',
            'area_circulo',
            'area_quadrado',
            'area_retangulo',
            'area_triangulo',
            'dias_entre_datas',
    ];

    public function __construct(CalculadoraService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return view('home', ['tipos' => self::TIPOS]);
    }

    public function show(string $tipo)
    {
        if (!in_array($tipo, self::TIPOS)) {
            abort(404);
        }

        return view('calculadoras.' . $tipo);
    }

    public function store(string $tipo, Request $request)
    {
        if (!in_array($tipo, self::TIPOS)) {
            abort(404);
        }

        switch ($tipo) {
            case 'regra_tres_simples':
                $dados = $request->validate([
                    'a' => 'required|numeric',
                    'b' => 'required|numeric',
                    'c' => 'required|numeric',
                ]);
                break;
            case 'resto_da_divisao':
                $dados = $request->validate([
                    'dividendo' => 'required|numeric',
                    'divisor' => 'required|numeric',
                ]);
                break;
            case 'porcentagem':
                $dados = $request->validate([
                    'porcentagem' => 'required|numeric',
                    'valor' => 'required|numeric',
                ]);
                break;
            case 'area_circulo':
                $dados = $request->validate([
                    'raio' => 'required|numeric',
                ]);
                break;
            case 'area_quadrado':
                $dados = $request->validate([
                    'lado' => 'required|numeric',
                ]);
                break;
            case 'area_retangulo':
                $dados = $request->validate([
                    'base' => 'required|numeric',
                    'altura' => 'required|numeric',
                ]);
                break;
            case 'area_triangulo':
                $dados = $request->validate([
                    'base' => 'required|numeric',
                    'altura' => 'required|numeric',
                ]);
                break;
            case 'dias_entre_datas':
                $dados = $request->validate([
                    'data_inicio' => 'required|date',
                    'data_fim' => 'required|date',
                ]);
                break;
            default:
                abort(404);
        }

        Calculo::create([
            'tipo' => $tipo,
        ]);

        return view('calculadoras.' . $tipo, ['resultado' => $this->service->calcular($tipo, $dados)]);
    }
}

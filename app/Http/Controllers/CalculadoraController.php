<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calculo;
use DateTime;

class CalculadoraController extends Controller
{
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
    public function index()
    {
        return view('home', ['tipos' => self::TIPOS]);
    }

    public function show(string $tipo)
    {
        if (!in_array($tipo, self::TIPOS)) {
            abort(404);
        }

        return view($tipo);
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
                $resultado = $dados['c'] * $dados['b'] / $dados['a'];
                break;
            case 'resto_da_divisao':
                $dados = $request->validate([
                    'dividendo' => 'required|numeric',
                    'divisor' => 'required|numeric',
                ]);
                $resultado = fmod($dados['dividendo'], $dados['divisor']);
                break;
            case 'porcentagem':
                $dados = $request->validate([
                    'porcentagem' => 'required|numeric',
                    'valor' => 'required|numeric',
                ]);
                $resultado = $dados['porcentagem'] * $dados['valor'] / 100;
                break;
            case 'area_circulo':
                $dados = $request->validate([
                    'raio' => 'required|numeric',
                ]);
                $resultado = M_PI * pow($dados['raio'], 2);
                break;
            case 'area_quadrado':
                $dados = $request->validate([
                    'lado' => 'required|numeric',
                ]);
                $resultado = pow($dados['lado'], 2);
                break;
            case 'area_retangulo':
                $dados = $request->validate([
                    'base' => 'required|numeric',
                    'altura' => 'required|numeric',
                ]);
                $resultado = $dados['base'] * $dados['altura'];
                break;
            case 'area_triangulo':
                $dados = $request->validate([
                    'base' => 'required|numeric',
                    'altura' => 'required|numeric',
                ]);
                $resultado = ($dados['base'] * $dados['altura']) / 2;
                break;
            case 'dias_entre_datas':
                $dados = $request->validate([
                    'data_inicio' => 'required|date',
                    'data_fim' => 'required|date',
                ]);
                $data_inicio = new DateTime($dados['data_inicio']);
                $data_fim = new DateTime($dados['data_fim']);
                $resultado = $data_inicio->diff($data_fim)->days;
                break;
            default:
                abort(404);
        }

        Calculo::create([
            'tipo' => $tipo,
        ]);

        return view($tipo, ['resultado' => $resultado]);
    }
}

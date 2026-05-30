<?php

namespace App\Services;

use DateTime;
use Exception;

class CalculadoraService
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

    public function regras(string $tipo): array
    {
        switch ($tipo) {
            case 'regra_tres_simples':
                return [
                    'a' => 'required|numeric',
                    'b' => 'required|numeric',
                    'c' => 'required|numeric',
                ];
            case 'resto_da_divisao':
                return [
                    'dividendo' => 'required|numeric',
                    'divisor' => 'required|numeric',
                ];
            case 'porcentagem':
                return [
                    'porcentagem' => 'required|numeric',
                    'valor' => 'required|numeric',
                ];
            case 'area_circulo':
                return [
                    'raio' => 'required|numeric',
                ];
            case 'area_quadrado':
                return [
                    'lado' => 'required|numeric',
                ];
            case 'area_retangulo':
                return [
                    'base' => 'required|numeric',
                    'altura' => 'required|numeric',
                ];
            case 'area_triangulo':
                return [
                    'base' => 'required|numeric',
                    'altura' => 'required|numeric',
                ];
            case 'dias_entre_datas':
                return [
                    'data_inicio' => 'required|date',
                    'data_fim' => 'required|date',
                ];
            default:
                throw new \InvalidArgumentException('Tipo inválido!');
        }
    }

    public function calcular(string $tipo, array $dados)
    {
        switch ($tipo) {
            case 'regra_tres_simples':
                $resultado = $dados['c'] * $dados['b'] / $dados['a'];
                break;
            case 'resto_da_divisao':
                $resultado = fmod($dados['dividendo'], $dados['divisor']);
                break;
            case 'porcentagem':
                $resultado = $dados['porcentagem'] * $dados['valor'] / 100;
                break;
            case 'area_circulo':
                $resultado = M_PI * pow($dados['raio'], 2);
                break;
            case 'area_quadrado':
                $resultado = pow($dados['lado'], 2);
                break;
            case 'area_retangulo':
                $resultado = $dados['base'] * $dados['altura'];
                break;
            case 'area_triangulo':
                $resultado = ($dados['base'] * $dados['altura']) / 2;
                break;
            case 'dias_entre_datas':
                $data_inicio = new DateTime($dados['data_inicio']);
                $data_fim = new DateTime($dados['data_fim']);
                $resultado = $data_inicio->diff($data_fim)->days;
                break;
            default:
                throw new \InvalidArgumentException('Tipo inválido!');
        }

        return $resultado;
    }
}
<?php

namespace App\Services;

use DateTime;

class CalculadoraService
{
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
@extends('layouts.app')

@section('content')
<div style="margin-bottom: 2.5rem;">
    <h1 style="font-family: 'Space Mono', monospace; font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem;">
        Calculadoras <span style="color: var(--accent)">Online</span>
    </h1>
    <p style="color: var(--text-muted); font-size: 0.9rem;">
        Escolha uma calculadora para começar
    </p>
</div>

@php
$grupos = [
    'Matemática' => [
        'porcentagem'      => 'Porcentagem',
        'regra_tres_simples' => 'Regra de Três Simples',
        'resto_da_divisao' => 'Resto da Divisão',
    ],
    'Áreas' => [
        'area_circulo'   => 'Área do Círculo',
        'area_quadrado'  => 'Área do Quadrado',
        'area_retangulo' => 'Área do Retângulo',
        'area_triangulo' => 'Área do Triângulo',
    ],
    'Datas' => [
        'dias_entre_datas' => 'Dias entre Datas',
    ],
];

$icones = [
    'porcentagem'        => '%',
    'regra_tres_simples' => '∝',
    'resto_da_divisao'   => '÷',
    'area_circulo'       => '◯',
    'area_quadrado'      => '□',
    'area_retangulo'     => '▭',
    'area_triangulo'     => '△',
    'dias_entre_datas'   => '📅',
];
@endphp

@foreach($grupos as $grupo => $calculadoras)
<div style="margin-bottom: 2.5rem;">
    <div style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.12em; color: var(--text-muted); margin-bottom: 0.8rem; font-weight: 600;">
        {{ $grupo }}
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 0.75rem;">
        @foreach($calculadoras as $tipo => $nome)
        <a href="/calculadoras/{{ $tipo }}" style="
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.2rem 1.4rem;
            text-decoration: none;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: border-color 0.2s, background 0.2s;
        "
        onmouseover="this.style.borderColor='var(--accent)'; this.style.background='var(--surface2)'"
        onmouseout="this.style.borderColor='var(--border)'; this.style.background='var(--surface)'"
        >
            <span style="font-size: 1.4rem; min-width: 28px; text-align: center;">{{ $icones[$tipo] }}</span>
            <span style="font-size: 0.88rem; font-weight: 500;">{{ $nome }}</span>
        </a>
        @endforeach
    </div>
</div>
@endforeach
@endsection

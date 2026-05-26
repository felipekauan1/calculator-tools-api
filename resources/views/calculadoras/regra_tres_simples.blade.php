@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">∝ Regra de Três Simples</div>

    @include('calculadoras._errors')

    <p style="font-size: 0.78rem; color: var(--text-muted); margin-bottom: 1.8rem; font-family: 'Space Mono', monospace;">
        X = (C × B) / A
    </p>

    <form method="POST" action="/calculadoras/regra_tres_simples">
        @csrf

        {{-- Linha 1: A está para B --}}
        <div style="display: grid; grid-template-columns: 1fr auto 1fr; align-items: end; gap: 1rem; margin-bottom: 0.75rem;">
            <div class="field" style="margin-bottom: 0;">
                <label>Valor de A</label>
                <input type="number" name="a" step="any" value="{{ old('a') }}" placeholder="ex: 10" required>
            </div>
            <div style="padding-bottom: 0.75rem; color: var(--text-muted); font-size: 0.78rem; text-align: center; white-space: nowrap;">
                está para
            </div>
            <div class="field" style="margin-bottom: 0;">
                <label>Valor de B</label>
                <input type="number" name="b" step="any" value="{{ old('b') }}" placeholder="ex: 50" required>
            </div>
        </div>

        {{-- Assim como --}}
        <div style="text-align: center; color: var(--accent); font-size: 0.78rem; font-family: 'Space Mono', monospace; margin-bottom: 0.75rem; letter-spacing: 0.1em;">
            assim como
        </div>

        {{-- Linha 2: C está para X --}}
        <div style="display: grid; grid-template-columns: 1fr auto 1fr; align-items: end; gap: 1rem; margin-bottom: 1.5rem;">
            <div class="field" style="margin-bottom: 0;">
                <label>Valor de C</label>
                <input type="number" name="c" step="any" value="{{ old('c') }}" placeholder="ex: 3" required>
            </div>
            <div style="padding-bottom: 0.75rem; color: var(--text-muted); font-size: 0.78rem; text-align: center; white-space: nowrap;">
                está para
            </div>
            <div class="field" style="margin-bottom: 0;">
                <label>X</label>
                @isset($resultado)
                    <div style="
                        background: var(--surface2);
                        border: 1px solid var(--accent);
                        border-radius: var(--radius);
                        padding: 0.7rem 1rem;
                        font-family: 'Space Mono', monospace;
                        font-size: 1.1rem;
                        color: var(--accent);
                        font-weight: 700;
                    ">{{ number_format($resultado, 4, ',', '.') }}</div>
                @else
                    <div style="
                        background: var(--surface2);
                        border: 1px dashed var(--border);
                        border-radius: var(--radius);
                        padding: 0.7rem 1rem;
                        font-family: 'Space Mono', monospace;
                        font-size: 0.9rem;
                        color: var(--text-muted);
                    ">?</div>
                @endisset
            </div>
        </div>

        <button type="submit" class="btn">Calcular X</button>
    </form>
</div>
@endsection

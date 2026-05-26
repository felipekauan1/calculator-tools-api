@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">▭ Área do Retângulo</div>

    @include('calculadoras._errors')

    @isset($resultado)
    <div class="resultado" style="margin-bottom: 1.5rem;">
        <div>
            <div class="resultado-label">Área (base × altura)</div>
            <div class="resultado-valor">{{ number_format($resultado, 2, ',', '.') }}</div>
        </div>
    </div>
    @endisset

    <form method="POST" action="/calculadoras/area_retangulo">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="field">
                <label>Base</label>
                <input type="number" name="base" step="any" value="{{ old('base') }}" placeholder="ex: 8" required>
            </div>
            <div class="field">
                <label>Altura</label>
                <input type="number" name="altura" step="any" value="{{ old('altura') }}" placeholder="ex: 5" required>
            </div>
        </div>
        <button type="submit" class="btn">Calcular</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">◯ Área do Círculo</div>

    @include('calculadoras._errors')

    @isset($resultado)
    <div class="resultado" style="margin-bottom: 1.5rem;">
        <div>
            <div class="resultado-label">Área (π × r²)</div>
            <div class="resultado-valor">{{ number_format($resultado, 4, ',', '.') }}</div>
        </div>
    </div>
    @endisset

    <form method="POST" action="/calculadoras/area_circulo">
        @csrf
        <div class="field">
            <label>Raio</label>
            <input type="number" name="raio" step="any" value="{{ old('raio') }}" placeholder="ex: 7" required>
        </div>
        <button type="submit" class="btn">Calcular</button>
    </form>
</div>
@endsection

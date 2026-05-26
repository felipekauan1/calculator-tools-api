@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">□ Área do Quadrado</div>

    @include('calculadoras._errors')

    @isset($resultado)
    <div class="resultado" style="margin-bottom: 1.5rem;">
        <div>
            <div class="resultado-label">Área (lado²)</div>
            <div class="resultado-valor">{{ number_format($resultado, 2, ',', '.') }}</div>
        </div>
    </div>
    @endisset

    <form method="POST" action="/calculadoras/area_quadrado">
        @csrf
        <div class="field">
            <label>Lado</label>
            <input type="number" name="lado" step="any" value="{{ old('lado') }}" placeholder="ex: 5" required>
        </div>
        <button type="submit" class="btn">Calcular</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">% Porcentagem</div>

    @include('calculadoras._errors')

    @isset($resultado)
    <div class="resultado" style="margin-bottom: 1.5rem;">
        <div>
            <div class="resultado-label">Resultado</div>
            <div class="resultado-valor">{{ number_format($resultado, 2, ',', '.') }}</div>
        </div>
    </div>
    @endisset

    <form method="POST" action="/calculadoras/porcentagem">
        @csrf
        <div class="field">
            <label>Porcentagem (%)</label>
            <input type="number" name="porcentagem" step="any" value="{{ old('porcentagem') }}" placeholder="ex: 15" required>
        </div>
        <div class="field">
            <label>Valor</label>
            <input type="number" name="valor" step="any" value="{{ old('valor') }}" placeholder="ex: 200" required>
        </div>
        <button type="submit" class="btn">Calcular</button>
    </form>
</div>
@endsection

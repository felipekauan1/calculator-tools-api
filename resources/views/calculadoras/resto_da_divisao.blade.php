@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">÷ Resto da Divisão</div>

    @include('calculadoras._errors')

    @isset($resultado)
    <div class="resultado" style="margin-bottom: 1.5rem;">
        <div>
            <div class="resultado-label">Resto</div>
            <div class="resultado-valor">{{ $resultado }}</div>
        </div>
    </div>
    @endisset

    <form method="POST" action="/calculadoras/resto_da_divisao">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="field">
                <label>Dividendo</label>
                <input type="number" name="dividendo" step="any" value="{{ old('dividendo') }}" placeholder="ex: 17" required>
            </div>
            <div class="field">
                <label>Divisor</label>
                <input type="number" name="divisor" step="any" value="{{ old('divisor') }}" placeholder="ex: 5" required>
            </div>
        </div>
        <button type="submit" class="btn">Calcular</button>
    </form>
</div>
@endsection

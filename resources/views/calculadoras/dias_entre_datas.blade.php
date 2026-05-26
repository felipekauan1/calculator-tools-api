@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-title">📅 Dias entre Datas</div>

    @include('calculadoras._errors')

    @isset($resultado)
    <div class="resultado" style="margin-bottom: 1.5rem;">
        <div>
            <div class="resultado-label">Total de dias</div>
            <div class="resultado-valor">{{ $resultado }} dias</div>
        </div>
    </div>
    @endisset

    <form method="POST" action="/calculadoras/dias_entre_datas">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="field">
                <label>Data Início</label>
                <input type="date" name="data_inicio" value="{{ old('data_inicio') }}" required>
            </div>
            <div class="field">
                <label>Data Fim</label>
                <input type="date" name="data_fim" value="{{ old('data_fim') }}" required>
            </div>
        </div>
        <button type="submit" class="btn">Calcular</button>
    </form>
</div>
@endsection

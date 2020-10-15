@extends('layouts.layout')

@section('content')
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Simular Cliente</h1>
                <p class="lead">Selecione o dia e horario de chegada e saída do cliente e saiba quanto tempo ele esperou dentro e fora do expediente da loja.</p>
            </div>
        </div>

        <div class="container">
            <form id="simulador">
                <div class="row">
                    <div class="col-lg-6">
                        <div id="dataEntradaGroup" class="form-group date" data-target-input="nearest">
                            <label for="dataEntrada">Entrada: </label>
                            <input name="start" type="text" class="form-control datetimepicker-input" data-target="#dataEntradaGroup" data-toggle="datetimepicker" id="dataEntrada" value="12/12/2020 12:12">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="dataSaidaGroup" class="form-group date" data-target-input="nearest">
                            <label for="dataSaida">Saída: </label>
                            <input name="end" type="text" class="form-control datetimepicker-input" data-target="#dataSaidaGroup" data-toggle="datetimepicker" id="dataSaida" value="02/01/2021 03:15">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-clock"></i> Simular</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-6">
                    <div id="time-expediente-holder">
                        <canvas id="time-expediente"></canvas>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5>Dentro do Expediente: <span id="tempoExpediente"></span></h5>
                    <h5>Fora do Expediente: <span id="tempoForaExpediente"></span></h5>
                    <h5>Tempo Total: <span id="tempoTotal"></span></h5>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script src="{{ asset('js/simular.js') }}"></script>
@endpush

@extends('layouts.layout')

@section('content')
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Horário de Expediente</h1>
                <p class="lead">Aqui está a lista de expedientes de acordo com o dia da semana!</p>
            </div>
        </div>

        <div class="container">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nº do Exp.</th>
                        <th scope="col">Domingo</th>
                        <th scope="col">Segunda-Feira</th>
                        <th scope="col">Terça-Feira</th>
                        <th scope="col">Quarta-Feira</th>
                        <th scope="col">Quinta-Feira</th>
                        <th scope="col">Sexta-Feira</th>
                        <th scope="col">Sábado</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < $maxShifts; ++$i)
                    <tr>
                        <th scope="row">{{$i + 1}}º</th>
                        @for($day = 0; $day <= 6; ++$day)
                        <td>{{ sizeof($dayOfWeekShifts[$day]) > $i ? parseMinutesToTimeString($dayOfWeekShifts[$day][$i]['start']).' ~ '.parseMinutesToTimeString($dayOfWeekShifts[$day][$i]['end']) : '-' }}</td>
                        @endfor
                    </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
@endsection

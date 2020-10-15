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
                    <tr>
                        <th scope="row">1º</th>
                        <td>07:00 ~ 12:00</td>
                        <td>07:00 ~ 12:00</td>
                        <td>07:00 ~ 12:00</td>
                        <td>07:00 ~ 12:00</td>
                        <td>07:00 ~ 12:00</td>
                        <td>07:00 ~ 12:00</td>
                        <td>07:00 ~ 12:00</td>
                    </tr>
                    <tr>
                        <th scope="row">2º</th>
                        <td>-</td>
                        <td>13:00 ~ 17:00</td>
                        <td>13:00 ~ 17:00</td>
                        <td>13:00 ~ 17:00</td>
                        <td>-</td>
                        <td>13:00 ~ 17:00</td>
                        <td>13:00 ~ 17:00</td>
                    </tr>
                    <tr>
                        <th scope="row">3º</th>
                        <td>-</td>
                        <td>18:00 ~ 21:00</td>
                        <td>18:00 ~ 21:00</td>
                        <td>18:00 ~ 21:00</td>
                        <td>18:00 ~ 21:00</td>
                        <td>18:00 ~ 21:00</td>
                        <td>-</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
@endsection

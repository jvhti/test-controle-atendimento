@extends('layouts.layout')

@section('content')

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Gerenciar Funcionarios</h1>
        </div>
    </div>

    <div class="container">
        <div class="text-right">
            <button class="btn btn-success" onclick="$('#newEmployee').modal()"><i class="fas fa-plus"></i> Novo
            </button>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table text-center">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Dias da Semana</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <th scope="row">{{$employee->id}}</th>
                        <td>{{$employee->name}}</td>
                        <td>
                        <span class="badge badge-success" data-placement="auto" data-toggle="tooltip"
                              title="Domingo: Sim">D</span>
                            <span class="badge badge-danger" data-placement="auto" data-toggle="tooltip"
                                  title="Segunda Feira: Não">S</span>
                            <span class="badge badge-danger" data-placement="auto" data-toggle="tooltip"
                                  title="Terça-Feira: Não">T</span>
                            <span class="badge badge-danger" data-placement="auto" data-toggle="tooltip"
                                  title="Quarta-Feira: Não">Q</span>
                            <span class="badge badge-danger" data-placement="auto" data-toggle="tooltip"
                                  title="Quinta-Feira: Não">Q</span>
                            <span class="badge badge-danger" data-placement="auto" data-toggle="tooltip"
                                  title="Sexta-Feira: Não">S</span>
                            <span class="badge badge-danger" data-placement="auto" data-toggle="tooltip"
                                  title="Sabádo: Não">S</span>
                        </td>
                        <td>
                            <button class="btn btn-info" data-placement="top" data-toggle="tooltip"
                                    onclick="showEmployee({{$employee->id}})"
                                    title="Detalhes" type="button"><i class="fas fa-search"></i><span class="sr-only">Detalhes</span>
                            </button>
                            <button class="btn btn-warning" data-placement="top" data-toggle="tooltip"
                                    onclick="editEmployee({{$employee->id}})"
                                    title="Editar" type="button"><i class="fas fa-user-edit"></i><span class="sr-only">Editar</span>
                            </button>
                            <button class="btn btn-danger" data-placement="top" data-toggle="tooltip" title="Excluir"
                                    type="button" onclick="confirmDeletion({{$employee->id}})"><i class="fas fa-trash-alt"></i><span
                                    class="sr-only">Excluir</span></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal" id="showEmployeeModal" tabindex="-1">
        <input type="hidden" id="showEmployeeId" value="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Funcionário #<span class="employee-number">1</span>: <span class="employee-name">João Víctor</span></h5>
                    <button aria-label="Fechar" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">-</th>
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
                                <th scope="row">Entrada</th>
                                <td>07:00</td>
                                <td>07:00</td>
                                <td>07:00</td>
                                <td>07:00</td>
                                <td>07:00</td>
                                <td>07:00</td>
                                <td>07:00</td>
                            </tr>
                            <tr>
                                <th scope="row">Saída</th>
                                <td>12:00</td>
                                <td>12:00</td>
                                <td>12:00</td>
                                <td>12:00</td>
                                <td>12:00</td>
                                <td>12:00</td>
                                <td>12:00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" onclick="$('#editEmployee').modal()"
                            type="button">
                        Editar
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" onclick="confirmDeletion($('#showEmployeeId').val())">
                        Apagar
                    </button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    @include('modals.newEmployee')
@endsection

@push('js')
    <script src="{{ asset('js/gerenciarFuncionario.js') }}"></script>
@endpush

@extends('layouts.layout')

@section('content')

    <main>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Gerenciar Funcionarios</h1>
            </div>
        </div>

        <div class="container">
            <div class="text-right">
                <button class="btn btn-success" onclick="$('#editEmployee').modal()"><i class="fas fa-plus"></i> Novo</button>
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
                    <tr>
                        <th scope="row">1</th>
                        <td>João Víctor</td>
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
                                    onclick="$('#showEmployeeModal').modal()"
                                    title="Detalhes" type="button"><i class="fas fa-search"></i><span class="sr-only">Detalhes</span>
                            </button>
                            <button class="btn btn-warning" data-placement="top" data-toggle="tooltip"
                                    onclick="$('#editEmployee').modal()"
                                    title="Editar" type="button"><i class="fas fa-user-edit"></i><span class="sr-only">Editar</span>
                            </button>
                            <button class="btn btn-danger" data-placement="top" data-toggle="tooltip" title="Excluir"
                                    type="button" onclick="confirmDeletion()"><i class="fas fa-trash-alt"></i><span class="sr-only">Excluir</span></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal" id="showEmployeeModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Funcionário: João Víctor</h5>
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
                    <button class="btn btn-warning" data-dismiss="modal" onclick="$('#editEmployee').modal()" type="button">
                        Editar
                    </button>
                    <button class="btn btn-danger" data-dismiss="modal" type="button" onclick="confirmDeletion()">Apagar</button>
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="editEmployee" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Funcionário #1</h5>
                    <button aria-label="Fechar" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input class="form-control" id="name" type="text" value="João Víctor">
                        </div>
                        <h4>Expediente:</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" checked value="">
                                                <span class="font-weight-bold">Domingo</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada0">Entrada:</label>
                                            <input class="form-control text-right" id="entrada0" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida0">Saída:</label>
                                            <input class="form-control text-right" id="saida0" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" checked value="">
                                                <span class="font-weight-bold">Segunda-Feira</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada1">Entrada:</label>
                                            <input class="form-control text-right" id="entrada1" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida1">Saída:</label>
                                            <input class="form-control text-right" id="saida1" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" checked value="">
                                                <span class="font-weight-bold">Terça-Feira</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada2">Entrada:</label>
                                            <input class="form-control text-right" id="entrada2" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida2">Saída:</label>
                                            <input class="form-control text-right" id="saida2" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" checked value="">
                                                <span class="font-weight-bold">Quarta-Feira</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada3">Entrada:</label>
                                            <input class="form-control text-right" id="entrada3" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida3">Saída:</label>
                                            <input class="form-control text-right" id="saida3" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" value="">
                                                <span class="font-weight-bold">Quinta-Feira</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada4">Entrada:</label>
                                            <input disabled class="form-control text-right" id="entrada4" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida4">Saída:</label>
                                            <input disabled class="form-control text-right" id="saida4" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" checked value="">
                                                <span class="font-weight-bold">Sexta-Feira</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada5">Entrada:</label>
                                            <input class="form-control text-right" id="entrada5" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida5">Saída:</label>
                                            <input class="form-control text-right" id="saida5" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4 position-relative">
                                        <div class="form-check toogle-day-of-the-week">
                                            <label>
                                                <input class="form-check-input" type="checkbox" checked value="">
                                                <span class="font-weight-bold">Sabádo</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="entrada6">Entrada:</label>
                                            <input class="form-control text-right" id="entrada6" type="text" value="07:00">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="saida6">Saída:</label>
                                            <input class="form-control text-right" id="saida6" type="text" value="07:00">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" data-dismiss="modal" type="submit" value="Salvar">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/gerenciarFuncionario.js') }}"></script>
@endpush

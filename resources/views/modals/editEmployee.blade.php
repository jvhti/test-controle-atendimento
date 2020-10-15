<div class="modal" id="editEmployee" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Funcionário #{{$employee->id}}</h5>
                <button aria-label="Fechar" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editEmployeeForm">
                <input type="hidden" id="editEmployeeId" name="id" value="{{$employee->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{$employee->name}}">
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
                                        <input class="form-control text-right" id="entrada0" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida0">Saída:</label>
                                        <input class="form-control text-right" id="saida0" type="text"
                                               value="07:00">
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
                                        <input class="form-control text-right" id="entrada1" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida1">Saída:</label>
                                        <input class="form-control text-right" id="saida1" type="text"
                                               value="07:00">
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
                                        <input class="form-control text-right" id="entrada2" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida2">Saída:</label>
                                        <input class="form-control text-right" id="saida2" type="text"
                                               value="07:00">
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
                                        <input class="form-control text-right" id="entrada3" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida3">Saída:</label>
                                        <input class="form-control text-right" id="saida3" type="text"
                                               value="07:00">
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
                                        <input disabled class="form-control text-right" id="entrada4" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida4">Saída:</label>
                                        <input disabled class="form-control text-right" id="saida4" type="text"
                                               value="07:00">
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
                                        <input class="form-control text-right" id="entrada5" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida5">Saída:</label>
                                        <input class="form-control text-right" id="saida5" type="text"
                                               value="07:00">
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
                                        <input class="form-control text-right" id="entrada6" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="saida6">Saída:</label>
                                        <input class="form-control text-right" id="saida6" type="text"
                                               value="07:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" type="submit" value="Salvar">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#editEmployeeForm').on('submit', (ev) => {
        ev.preventDefault();
        saveEmployee($("#editEmployeeId").val(), $("#editEmployeeForm").serializeArray());
    });
</script>

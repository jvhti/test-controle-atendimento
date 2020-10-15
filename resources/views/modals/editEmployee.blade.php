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
                        @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 0])@endcomponent
                            @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 1])@endcomponent
                    </div>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 2])@endcomponent
                        @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 3])@endcomponent
                    </div>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 4])@endcomponent
                        @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 5])@endcomponent
                    </div>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => $employee, 'dayOfWeek' => 6])@endcomponent
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
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

    $('#editEmployeeForm input[type=checkbox][name^=enable]').on('click', (ev) => {
        const $enable = $(ev.target);
        const dayOfWeek = $(ev.target).data('dayOfWeek');

        if($enable.is(":checked")){
            $(`#editEmployeeForm input[name=entrada${dayOfWeek}]`).attr('disabled', null);
            $(`#editEmployeeForm input[name=saida${dayOfWeek}]`).attr('disabled', null);
        }else{
            $(`#editEmployeeForm input[name=entrada${dayOfWeek}]`).val('').attr('disabled', true);
            $(`#editEmployeeForm input[name=saida${dayOfWeek}]`).val('').attr('disabled', true);
        }
    });
</script>

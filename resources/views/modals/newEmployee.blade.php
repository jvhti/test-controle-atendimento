<div class="modal" id="newEmployee" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Criar Novo Funcionário</h5>
                <button aria-label="Fechar" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newEmployeeForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input class="form-control" id="name" name="name" type="text" value="">
                    </div>
                    <h4>Expediente:</h4>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 0])@endcomponent
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 1])@endcomponent
                    </div>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 2])@endcomponent
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 3])@endcomponent
                    </div>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 4])@endcomponent
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 5])@endcomponent
                    </div>
                    <div class="row">
                        @component('modals.components.employeeShiftDay', ['employee' => null, 'dayOfWeek' => 6])@endcomponent
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

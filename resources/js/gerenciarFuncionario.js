const bootbox = require('bootbox');
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/modal');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('#newEmployeeForm').on('submit', (ev) => {
        ev.preventDefault();
        saveEmployee(null, $("#newEmployeeForm").serializeArray());
    });

    $('#newEmployeeForm input[type=checkbox][name^=enable]').on('click', (ev) => {
        const $enable = $(ev.target);
        const dayOfWeek = $(ev.target).data('dayOfWeek');

        if($enable.is(":checked")){
            $(`#newEmployeeForm input[name=entrada${dayOfWeek}]`).attr('disabled', null);
            $(`#newEmployeeForm input[name=saida${dayOfWeek}]`).attr('disabled', null);
        }else{
            $(`#newEmployeeForm input[name=entrada${dayOfWeek}]`).val('').attr('disabled', true);
            $(`#newEmployeeForm input[name=saida${dayOfWeek}]`).val('').attr('disabled', true);
        }
    });
});

function confirmDeletion(id) {
    bootbox.confirm({
        message: `Você realmente deseja excluir o funcionário #${id}?`,
        buttons: {
            cancel: {
                label: 'Cancelar',
                className: 'btn-secondary'
            },
            confirm: {
                label: 'Excluir',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                showLoadingIndicator();
                $.ajax('api/employee/' + id, {method: 'DELETE'}).done((res) => {
                    hideLoadingIndicator();
                    if (res.success)
                        setTimeout(() => navigateTo(window.location.href), 400);
                });
            }
        }
    });
}

function showEmployee(id) {
    showLoadingIndicator();
    $.ajax('api/employee/' + id).done((res) => {
        hideLoadingIndicator();
        $("#showEmployeeModal").find('.employee-name').html(res.name);
        $("#showEmployeeModal").find('.employee-number').html(res.id);
        $("#showEmployeeId").val(res.id);

        const daysOfWeek = [];

        for(let i = 0; i < res.shifts.length; ++i){
            const shift = res.shifts[i];
            daysOfWeek[shift.day_of_week] = {start: shift.start_time, end: shift.end_time};
        }

        const parseMinutesToString = (minutes) => {
          const hours = Math.floor(minutes / 60);

          return hours.toString().padStart(2, '0') + ':' + minutes % 60;
        };

        $("#showEmployeeModal-startTime td:not(:first-child)").each((i, el) => {
            if(!daysOfWeek[i]) return $(el).text('-');
            $(el).text(parseMinutesToString(daysOfWeek[i].start));
        });

        $("#showEmployeeModal-endTime td:not(:first-child)").each((i, el) => {
            if(!daysOfWeek[i]) return $(el).text('-');
            $(el).text(parseMinutesToString(daysOfWeek[i].end));
        });


        $("#showEmployeeModal").modal();
    });
}

function editEmployee(id) {
    showLoadingIndicator();
    $.ajax('employee/' + id + '/edit').done((res) => {
        if ($('#editEmployee').length)
            $('#editEmployee').remove();

        $('body').append($(res));

        setTimeout(() => {
            hideLoadingIndicator();
            $('#editEmployee').modal();
        }, 100);
    });
}

function saveEmployee(id, data) {
    const parsedData = {};
    const $form = $(`#${id ? 'edit' : 'new'}EmployeeForm`);

    $form.find('button[type=submit]').attr('disabled', true).html("<span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span> Carregando...");

    for (const i in data)
        parsedData[data[i].name] = data[i].value;

    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').remove();

    $.ajax('api/employee' + (id ? '/' + id : ''), {
        method: id ? 'PUT' : 'POST',
        data: parsedData,
        success: res => {
            if (res.success)
                setTimeout(() => {
                    navigateTo(window.location.href);

                    const $modal = $(`#${id ? 'edit' : 'new'}Employee`).modal("hide");
                    $(".modal-backdrop.show").remove();
                    $("body").removeClass('modal-open');

                    if (id)
                        $modal.remove();
                    else
                        $form.find('button[type=submit]').attr("disabled", null).html("Salvar");

                }, 400);
        },
        error: (req, status, error) => {
            const errors = req.responseJSON.errors;

            for (const field in errors) {
                const $input = $form.find(`[name="${field}"]`);
                $input.removeClass('is-valid').addClass('is-invalid');
                $input.parent().append($(`<div class="invalid-feedback">${errors[field][0]}</div>`));
            }
            $form.find('button[type=submit]').attr("disabled", null).html("Salvar");
        }
    });
}


window.confirmDeletion = confirmDeletion;
window.showEmployee = showEmployee;
window.editEmployee = editEmployee;
window.saveEmployee = saveEmployee;

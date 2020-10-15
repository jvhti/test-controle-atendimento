const bootbox = require('bootbox');
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/modal');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('#newEmployeeForm').on('submit', (ev) => {
        ev.preventDefault();
        saveEmployee(null, $("#newEmployeeForm").serializeArray());
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
                $.ajax('api/employee/' + id, {method: 'DELETE'}).done((res) => {
                    if (res.success)
                        setTimeout(() => navigateTo(window.location.href), 400);
                });
            }
        }
    });
}

function showEmployee(id) {
    $.ajax('api/employee/' + id).done((res) => {
        console.log(res);
        $("#showEmployeeModal").find('.employee-name').html(res.name);
        $("#showEmployeeModal").find('.employee-number').html(res.id);
        $("#showEmployeeId").val(res.id);
        $("#showEmployeeModal").modal();
    });
}

function editEmployee(id) {
    $.ajax('employee/' + id + '/edit').done((res) => {
        if ($('#editEmployee').length)
            $('#editEmployee').remove();

        $('body').append($(res));

        setTimeout(() => {
            $('#editEmployee').modal();
        }, 100);
    });
}

function saveEmployee(id, data) {
    const parsedData = {};
    const $form = $(`#${id ? 'edit' : 'new'}EmployeeForm`);

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

                }, 400);
        },
        error: (req, status, error) => {
            const errors = req.responseJSON.errors;

            for (const field in errors) {
                const $input = $form.find(`[name="${field}"]`);
                $input.removeClass('is-valid').addClass('is-invalid');
                $input.parent().append($(`<div class="invalid-feedback">${errors[field][0]}</div>`));
            }
        }
    });
}


window.confirmDeletion = confirmDeletion;
window.showEmployee = showEmployee;
window.editEmployee = editEmployee;
window.saveEmployee = saveEmployee;

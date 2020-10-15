const bootbox = require('bootbox');
require('bootstrap/js/dist/tooltip');
require('bootstrap/js/dist/modal');

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function confirmDeletion() {
    bootbox.confirm({
        message: "Você realmente deseja excluir o funcionário #1?",
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
            if (result){
                console.log("Delete employee");
            }
        }
    });
}


window.confirmDeletion = confirmDeletion;

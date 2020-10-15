window.moment = require('moment/moment');
require('moment/locale/pt-br');
require('tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min');
require('tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css');

const Chart = require('chart.js');

var config = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [
                120,
                350
            ],
            backgroundColor: [
                'rgb(0,255,0)',
                'rgb(255,0,0)'
            ],
            label: 'Simulação'
        }],
        labels: [
            'Dentro do Expediente',
            'Fora do Expediente'
        ]
    },
    options: {
        responsive: true,
        legend: {
            position: 'top',
        },
        title: {
            display: true,
            text: 'Simulação de tempo dentro e fora do expediente'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        tooltips:{
            callbacks:{
                label: function (tooltipItem, data) {
                    let label = data.labels[tooltipItem.index] || '';

                    if (label){
                        label += ': ';
                    }

                    let min = data.datasets[0].data[tooltipItem.index];
                    let hr = Math.floor(min / 60);
                    min = min % 60;

                    label += (hr ? hr + 'h' + ' ' : '') + (min ? min + 'm' : '');

                    return label;
                }
            }
        }
    }
};

(function() {
    var ctx = document.getElementById('time-expediente').getContext('2d');
    window.myDoughnut = new Chart(ctx, config);
})();

$(function () {
    $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right',
            today: 'fas fa-calendar-check-o',
            clear: 'fas fa-trash',
            close: 'fas fa-times'
        } });

    $('#dataEntradaGroup').datetimepicker();
    $('#dataSaidaGroup').datetimepicker({useCurrent: false});


    $("#dataEntradaGroup").on("change.datetimepicker", function (e) {
        $('#dataSaidaGroup').datetimepicker('minDate', e.date);
    });
    $("#dataSaidaGroup").on("change.datetimepicker", function (e) {
        $('#dataEntradaGroup').datetimepicker('maxDate', e.date);
    });
});

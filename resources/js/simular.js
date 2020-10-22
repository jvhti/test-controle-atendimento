window.moment = require('moment/moment');
require('moment/locale/pt-br');
require('tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min');
require('tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css');

const Chart = require('chart.js');

var config = {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [],
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


    $("#simulador").on('submit', (ev) => {
        ev.preventDefault();
        showLoadingIndicator();
        $.ajax('/api/simulate?'+ $("#simulador").serialize()).done((res) =>{
            const parseMinutesToTimeString = (minutes) => {
                const hours = Math.floor(minutes / 60);
                return hours.toString().padStart(2, '0') + ':' + (minutes % 60).toString().padStart(2, '0');
            };

            $("#tempoExpediente").text("aprox. " + moment.duration(res.timeInShift, 'minutes').humanize() + ` (${parseMinutesToTimeString(res.timeInShift)})`);
            $("#tempoForaExpediente").text("aprox. " + moment.duration(res.timeOutOfShift, 'minutes').humanize() + ` (${parseMinutesToTimeString(res.timeOutOfShift)})`);
            $("#tempoTotal").text("aprox. " + moment.duration(res.totalTime, 'minutes').humanize() + ` (${parseMinutesToTimeString(res.totalTime)})`);

            window.myDoughnut.data.datasets[0].data = [res.timeInShift, res.timeOutOfShift];
            window.myDoughnut.update();
            hideLoadingIndicator();
        });
    });
})();

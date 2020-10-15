window.jQuery = require('jquery');
window.$ = window.jQuery;
require('bootstrap');

$(function() {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    function updateActiveMenu(url){
        $('.nav-item').removeClass('active');
        $(".nav-item span.sr-only").remove();
        $(`a.nav-link[href="${url}"]`).parent('.nav-item').addClass('active').append($('<span class="sr-only"> (atual)</span>'));
    }

    $('a.nav-link').on('click', (ev) => {
        ev.preventDefault();
        const $el = $(ev.target);

        $.get($el.attr('href'), (page) => {
            $('#content').html(page);
            window.history.pushState({"html": page}, "", $el.attr('href'));
            updateActiveMenu($el.attr('href'));
        });
    });

    window.onpopstate = function(e){
        if(e.state){
            $("#content").html(e.state.html);
            updateActiveMenu(window.location.href);
        }
    };
});

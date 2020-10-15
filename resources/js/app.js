window.jQuery = require('jquery');
window.$ = window.jQuery;
require('bootstrap');


window.showLoadingIndicator = function(){
    if($("body").find("#loadingIndicator").length) return;

    $("body").append($(`<div id="loadingIndicator"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
  <span class="sr-only">Loading...</span>
</div></div>`));
};

window.hideLoadingIndicator = function(){
    const indicator = $("body").find("#loadingIndicator");
    if(!indicator.length) return;

    indicator.remove();
}

$(function() {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 'X-REQUESTED-WITH': 'XMLHttpRequest'},
    });

    function updateActiveMenu(url){
        $('.nav-item').removeClass('active');
        $(".nav-item span.sr-only").remove();
        $(`a.nav-link[href="${url}"]`).parent('.nav-item').addClass('active').append($('<span class="sr-only"> (atual)</span>'));
    }

    function navigateTo(url){
        showLoadingIndicator();
        $.get(url, (page) => {
            $('#content').html(page);
            window.history.pushState({"html": page}, "", url);
            updateActiveMenu(url);
            hideLoadingIndicator();
        });
    }

    $('a.nav-link, a.navbar-brand').on('click', (ev) => {
        ev.preventDefault();
        const $el = $(ev.target);

        navigateTo($el.attr('href'));
    });

    window.onpopstate = function(e){
        if(e.state){
            $("#content").html(e.state.html);
            updateActiveMenu(window.location.href);
        }
    };

    window.navigateTo = navigateTo;
});

// makes sure the whole site is loaded
jQuery(window).load(function() {
    // will fade out the whole DIV that covers the website.
    jQuery("#n-site-preloader").delay(700).fadeOut("slow");
});


$(document).ready(function(){

    $('.modal-trigger').leanModal();

    $('select').material_select();

    // Form Submit Buttons
    $('div.card-action').on('click', '.n-submit-btn', function(){
        var form = $(this).closest("form");
        form.submit();
    });

    $('form').on('click', '.n-submit-btn', function(){
        var form = $(this).closest("form");
        form.submit();
    });

    $('div.modal-footer').on('click', '.n-submit-btn', function(){
        var form = $(this).closest("form");
        form.submit();
    });
});

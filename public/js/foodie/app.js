$(document).ready(function() {
    $('select').material_select();
    $('.button-collapse').sideNav({
        menuWidth: 300
    });

    $(document).on('click', '#logout-link', function () {
        $('form#logout').submit();
    });
});
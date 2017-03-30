$(document).ready(function() {
    $('select').material_select();
    $('.button-collapse').sideNav({
        menuWidth: 300
    });

    $(document).on('click', '#logout-link', function () {
        $('form#logout').submit();
    });


    $(document).on('click', '#foodieProfile', function () {
        document.location.href=profileRoute;
    });

    $(document).on('click', '#viewChefs', function () {
        document.location.href=chefRoute;
    });

    $(document).on('click', '#viewMessages', function () {
        document.location.href=messageRoute;
    });
});
var idleTime = 0;

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 120) { // 20 minutes
        console.log('timeout');
        window.location.href= logoutRoute;
    }
}

$(document).ready(function() {
    $('select').material_select();
    $('.button-collapse').sideNav({
        menuWidth: 300
    });

    $(document).on('click', '#logout-link', function () {
        $('form#logout').submit();
    });

    function notifAjax(){
        return $.ajax({
            url: '/foodie/notifClear'
        });
    }

    // notifBadge
    $(document).on('click','#notifLink', function(){
        var notif = notifAjax();
        notif.done(function(){
            $('#notifBadge').empty();
        });
    });


    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        console.log(idleTime);
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        console.log('press');
        idleTime = 0;
    });


    // $(document).on('click', '#foodieProfile', function () {
    //     document.location.href=profileRoute;
    // });
    //
    // $(document).on('click', '#viewChefs', function () {
    //     document.location.href=chefRoute;
    // });
    //
    // $(document).on('click', '#viewMessages', function () {
    //     document.location.href=messageRoute;
    // });
});




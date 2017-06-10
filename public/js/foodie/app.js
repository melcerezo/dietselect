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


    var notifications = notifAjax();
    // '+orderAllRoute+'
    notifications.done(function (response) {
        var notifUnreadCount = 0;
        var notifs=response;
        $.each(notifs,function(index){
            var notifCntnt=
                '<li id="notif'+notifs[index].id+'" class="collection-item">'+
                    '<a class="msgLink notifLink" href="#" data-id="'+notifs[index].id+'">'+
                        '<div class="row msCntr">'+
                            '<div class="msMsCnt col s12">'+
                                '<span>'+notifs[index].notification+'</span>'+
                                '<div style="margin-top: 5px; color:cornflowerblue;">' +
                                    '<span>'+notifs[index].created_at+'</span>' +
        '                       </div>'+
                            '</div>'+
                        '</div>'+
                    '</a>'+
                '</li>';

            $('#foodieNotificationDropdown').append(notifCntnt);
            if(notifs[index].is_read==0){
                notifUnreadCount+=1;
                $('#notif'+notifs[index].id).addClass('activeNotif');
            }
        });
        // console.log(notifUnreadCount);
        var notifBdge= '<span class="new badge red">'+notifUnreadCount+'</span>';
        if(notifUnreadCount>0){
            $('#notifBadge').append(notifBdge);
        }

        $('.notifLink').on('click', function(){
            var notifId=$(this).attr("data-id");
            console.log(notifId);
            var notifClear = clearNotif(notifId);

            notifClear.done(function(){
                var notifCount = 0;
                $('#notif'+notifId).removeClass('activeNotif');
                $('#notifBadge').remove();
                $.each(notifs,function(index) {
                    if(notifs[index].is_read==0){
                        notifCount+=1;
                    }
                });
                var notifBdge= '<span class="new badge red">'+notifCount+'</span>';
                if(notifCount>0){
                    $('#notifBadge').append(notifBdge);
                }
            });
            // notif.done(function(response){
            //
            //
            //     $('#notifBadge').empty();
            //
            // });
        });

    });


    // <li class="collection-item">
    //     <a class="msgLink" href="{{route('foodie.order.view')}}">
    //     <div class="row msCntr">
    //     <div class="msMsCnt col s12">
    //     <span>{{$notification->notification}}</span>
    // </div>
    // </div>
    // </a>


    // notifBadge



    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        // console.log(idleTime);
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


function notifAjax(){
    return $.ajax({
        url: '/foodie/notifGet',
        dataType:'json'
    });
}

function clearNotif(id){
    return $.ajax({
        url: '/foodie/notifClear',
        type:'GET',
        data: {id:id}
    });

}

$(document).ready(function() {
    $(document).on("click", "#logout-link", function () {
        $('form#logout').submit();
    });

    var notifications = notifAjax();
    // '+orderAllRoute+'
    notifications.done(function (response) {
        var notifUnreadCount = 0;
        var notifs=response;
        $.each(notifs,function(index){
            var notifCntnt='';
            if(notifs[index].notification_type==0){
                notifCntnt=
                    '<li id="notif'+notifs[index].id+'" class="collection-item">'+
                    '<a class="msgLink notifLink" href="'+orderAllRoute+'" data-id="'+notifs[index].id+'">'+
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
            }else if(notifs[index].notification_type==1){
                notifCntnt=
                    '<li id="notif'+notifs[index].id+'" class="collection-item">'+
                    '<a class="msgLink notifLink" href="'+pendRoute+'" data-id="'+notifs[index].id+'">'+
                    '<div class="row msCntr">'+
                    '<div class="msMsCnt col s12">'+
                    '<span>'+notifs[index].notification+'</span>'+
                    '<div style="margin-top: 5px; color:cornflowerblue;">' +
                    '<span>'+notifs[index].created_at+'</span>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</li>';
            }else if(notifs[index].notification_type==2){
                notifCntnt=
                    '<li id="notif'+notifs[index].id+'" class="collection-item">'+
                    '<a class="msgLink notifLink" href="'+paidRoute+'" data-id="'+notifs[index].id+'">'+
                    '<div class="row msCntr">'+
                    '<div class="msMsCnt col s12">'+
                    '<span>'+notifs[index].notification+'</span>'+
                    '<div style="margin-top: 5px; color:cornflowerblue;">' +
                    '<span>'+notifs[index].created_at+'</span>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</li>';
            }else if(notifs[index].notification_type==3){
                notifCntnt=
                    '<li id="notif'+notifs[index].id+'" class="collection-item">'+
                    '<a class="msgLink notifLink" href="'+cancelRoute+'" data-id="'+notifs[index].id+'">'+
                    '<div class="row msCntr">'+
                    '<div class="msMsCnt col s12">'+
                    '<span>'+notifs[index].notification+'</span>'+
                    '<div style="margin-top: 5px; color:cornflowerblue;">' +
                    '<span>'+notifs[index].created_at+'</span>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</li>';
            }else if(notifs[index].notification_type==4){
                notifCntnt=
                    '<li id="notif'+notifs[index].id+'" class="collection-item">'+
                    '<a class="msgLink notifLink" href="'+deliverRoute+'" data-id="'+notifs[index].id+'">'+
                    '<div class="row msCntr">'+
                    '<div class="msMsCnt col s12">'+
                    '<span>'+notifs[index].notification+'</span>'+
                    '<div style="margin-top: 5px; color:cornflowerblue;">' +
                    '<span>'+notifs[index].created_at+'</span>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</a>'+
                    '</li>';
            }

            $('#chefNotificationDropdown').append(notifCntnt);
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

        $('#clearAll').click(function () {
            console.log('clearing');
            var clearNotifs= clearAllNotif();
            clearNotifs.done(function () {
                console.log('cleared');
                $.each(notifs,function(index) {
                    $('#chefNotificationDropdown').children().removeClass('activeNotif');
                });
                $('#notifBadge').remove();
            });
        });

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
        });

    });


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

});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 120) { // 20 minutes
        console.log('timeout');
        window.location.href= logoutRoute;
    }
}

function notifAjax(){
    return $.ajax({
        url: '/chef/notifGet',
        dataType:'json'
    });
}

function clearNotif(id){
    return $.ajax({
        url: '/chef/notifClear',
        type:'GET',
        data: {id:id}
    });

}

function clearAllNotif(){
    return $.ajax({
        url: '/chef/notifClearAll'
    });
}
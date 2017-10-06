$(document).ready(function() {
    $(document).on("click", "#logout-link", function () {
        $('form#logout').submit();
    });

    $('#allCom').show();
    $('#pendCom').hide();
    $('#paidCom').hide();
    $('#dayCom').hide();
    $('#weekCom').hide();
    $('#monthCom').hide();
    $('#yearCom').hide();

    $('#allLinkContain').addClass('activeTab');

    $('#orderFilter').change(function () {
        var value = $('select#orderFilter option:selected').val();
        if(value==1){
            $('#comAll').hide();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').show();
            $('#weekCom').hide();
            $('#monthCom').hide();
            $('#yearCom').hide();
        }else if(value==2){
            $('#comAll').hide();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').show();
            $('#monthCom').hide();
            $('#yearCom').hide();
        }else if(value==3){
            $('#comAll').hide();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').hide();
            $('#monthCom').show();
            $('#yearCom').hide();
        }else if(value==4){
            $('#comAll').hide();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').hide();
            $('#monthCom').hide();
            $('#yearCom').show();
        }else if(value==5){
            $('#comAll').show();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').hide();
            $('#monthCom').hide();
            $('#yearCom').hide();
        }
    });

    $('#pendOrderFilter').change(function () {
        var value = $('select#pendOrderFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#dayCom').show();
            $('#pendweekCom').hide();
            $('#pendmonthCom').hide();
            $('#pendyearCom').hide();
        }else if(value==2){
            $('#allCom').hide();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#pendweekCom').show();
            $('#pendmonthCom').hide();
            $('#pendyearCom').hide();
        }else if(value==3){
            $('#allCom').hide();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#pendweekCom').hide();
            $('#pendmonthCom').show();
            $('#pendyearCom').hide();
        }else if(value==4){
            $('#allCom').hide();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#pendweekCom').hide();
            $('#pendmonthCom').hide();
            $('#pendyearCom').show();
        }else if(value==5){
            $('#allCom').hide();
            $('#allPend').show();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#pendweekCom').hide();
            $('#pendmonthCom').hide();
            $('#pendyearCom').hide();
        }
    });
    $('#paidOrderFilter').change(function () {
        var value = $('select#paidOrderFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').hide();
            $('#paidweekCom').show();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==3){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paidpaiddayCom').hide();
            $('#paidpaidweekCom').hide();
            $('#paidpaidmonthCom').show();
            $('#paidpaidyearCom').hide();
        }else if(value==4){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').hide();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').show();
        }else if(value==5){
            $('#allCom').show();
            $('#pendCom').hide();
            $('#allPaid').show();
            $('#paiddayCom').hide();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }
    });

    $('.allLink').click(function () {
        $('#allLinkContain').addClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');

        $('select#orderFilter').val('5');
        $('select#orderFilter').material_select();
        $('#allCom').show();
        $('#comAll').show();
        $('#pendCom').hide();
        $('#paidCom').hide();
        $('#dayCom').hide();
        $('#weekCom').hide();
        $('#monthCom').hide();
        $('#yearCom').hide();
    });
    $('.pendLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').addClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');

        $('#allCom').hide();
        $('#pendCom').show();
        $('#allPend').show();
        $('#paidCom').hide();
        $('#penddayCom').hide();
        $('#pendweekCom').hide();
        $('#pendmonthCom').hide();
        $('#pendyearCom').hide();
    });
    $('.paidLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').addClass('activeTab');

        $('#allCom').hide();
        $('#pendCom').hide();
        $('#paidCom').show();
        $('#allPaid').show();
        $('#paiddayCom').hide();
        $('#paidweekCom').hide();
        $('#paidmonthCom').hide();
        $('#paidyearCom').hide();
    });


});
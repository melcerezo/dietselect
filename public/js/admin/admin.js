$(document).ready(function() {
    $(document).on("click", "#logout-link", function () {
        $('form#logout').submit();
    });

    // commissions page

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
        console.log(value);
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

        var value = $('select#orderFilter option:selected').val();
        console.log(value);
        if(value == 5){
            $('#allCom').show();
            $('#comAll').show();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').hide();
            $('#monthCom').hide();
            $('#yearCom').hide();
        }else if(value == 2){
            $('#allCom').hide();
            $('#comAll').show();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').show();
            $('#monthCom').hide();
            $('#yearCom').hide();
            console.log(value);
        }else if(value == 3){
            $('#allCom').hide();
            $('#comAll').show();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').hide();
            $('#monthCom').show();
            $('#yearCom').hide();
        }else if(value == 4){
            $('#allCom').hide();
            $('#comAll').show();
            $('#pendCom').hide();
            $('#paidCom').hide();
            $('#dayCom').hide();
            $('#weekCom').hide();
            $('#monthCom').hide();
            $('#yearCom').show();
        }

        // $('#allCom').show();
        // $('#comAll').show();
        // $('#pendCom').hide();
        // $('#paidCom').hide();
        // $('#dayCom').hide();
        // $('#weekCom').hide();
        // $('#monthCom').hide();
        // $('#yearCom').hide();
    });
    $('.pendLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').addClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');

        var value = $('select#pendOrderFilter option:selected').val();

        if(value==5){
            $('#allCom').hide();
            $('#pendCom').show();
            $('#allPend').show();
            $('#paidCom').hide();
            $('#penddayCom').hide();
            $('#pendweekCom').hide();
            $('#pendmonthCom').hide();
            $('#pendyearCom').hide();
        }else if(value==2){
            $('#allCom').hide();
            $('#pendCom').show();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#penddayCom').hide();
            $('#pendweekCom').show();
            $('#pendmonthCom').hide();
            $('#pendyearCom').hide();
        }else if(value==3){
            $('#allCom').hide();
            $('#pendCom').show();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#penddayCom').hide();
            $('#pendweekCom').hide();
            $('#pendmonthCom').show();
            $('#pendyearCom').hide();
        }else if(value==4){
            $('#allCom').hide();
            $('#pendCom').show();
            $('#allPend').hide();
            $('#paidCom').hide();
            $('#penddayCom').hide();
            $('#pendweekCom').hide();
            $('#pendmonthCom').hide();
            $('#pendyearCom').show();
        }


    });
    $('.paidLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').addClass('activeTab');

        var value = $('select#paidOrderFilter option:selected').val();

        if(value==5){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#paidCom').show();
            $('#allPaid').show();
            $('#paiddayCom').hide();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#paidCom').show();
            $('#allPaid').hide();
            $('#paiddayCom').hide();
            $('#paidweekCom').show();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==3){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#paidCom').show();
            $('#allPaid').hide();
            $('#paiddayCom').hide();
            $('#paidweekCom').hide();
            $('#paidmonthCom').show();
            $('#paidyearCom').hide();
        }else if(value==4){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#paidCom').show();
            $('#allPaid').hide();
            $('#paiddayCom').hide();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').show();
        }



    });

    // orders page

    $('#orderPageAll').show();
    $('#orderPagePend').hide();
    $('#orderPagePaid').hide();
    $('#orderWeekPicker').hide();
    $('#orderMonthPicker').hide();
    $('#orderYearPicker').hide();

    $('#allOrderLinkContain').addClass('activeTab');

    // var orderAllTable= $('#orderAllTable');
    $('#orderAllTable').show();
    $('#orderWeekPicker').hide();
    $('#orderMonthPicker').hide();
    $('#orderYearPicker').hide();



    $('#orderPageFilter').change(function () {
        var value = $('select#orderPageFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').hide();
            $('#orderWeekPicker').show();
            $('#orderMonthPicker').hide();
            $('#orderYearPicker').hide();
        }else if(value==3){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').hide();
            $('#orderWeekPicker').hide();
            $('#orderMonthPicker').show();
            $('#orderYearPicker').hide();
        }else if(value==4){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').hide();
            $('#orderWeekPicker').hide();
            $('#orderMonthPicker').hide();
            $('#orderYearPicker').show();
        }else if(value==5){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderAllTable').show();
            $('#orderWeekPicker').hide();
            $('#orderMonthPicker').hide();
            $('#orderYearPicker').hide();
        }
    });

    $('#orderPendFilter').change(function () {
        var value = $('select#orderPendFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').hide();
            $('#orderPendWeekPicker').show();
            $('#orderPendMonthPicker').hide();
            $('#orderPendYearPicker').hide();
        }else if(value==3){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').hide();
            $('#orderPendWeekPicker').hide();
            $('#orderPendMonthPicker').show();
            $('#orderPendYearPicker').hide();
        }else if(value==4){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPageAll').hide();
            $('#orderPendAllTable').hide();
            $('#orderPendWeekPicker').hide();
            $('#orderPendMonthPicker').hide();
            $('#orderPendYearPicker').show();
        }else if(value==5){
            $('#orderPageCancel').hide();
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPendAllTable').show();
            $('#orderPendWeekPicker').hide();
            $('#orderPendMonthPicker').hide();
            $('#orderPendYearPicker').hide();
        }
    });

    $('#orderPaidFilter').change(function () {
        var value = $('select#orderPaidFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').hide();
            $('#orderPaidWeekPicker').show();
            $('#orderPaidMonthPicker').hide();
            $('#orderPaidYearPicker').hide();
        }else if(value==3){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').hide();
            $('#orderPaidWeekPicker').hide();
            $('#orderPaidMonthPicker').show();
            $('#orderPaidYearPicker').hide();
        }else if(value==4){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').hide();
            $('#orderPaidWeekPicker').hide();
            $('#orderPaidMonthPicker').hide();
            $('#orderPaidYearPicker').show();
        }else if(value==5){
            $('#orderPageCancel').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderPaidAllTable').show();
            $('#orderPaidWeekPicker').hide();
            $('#orderPaidMonthPicker').hide();
            $('#orderPaidYearPicker').hide();
        }
    });

    $('#orderCancelFilter').change(function () {
        var value = $('select#orderCancelFilter option:selected').val();
        if(value==1){
            $('#allCom').hide();
            $('#pendCom').hide();
            $('#allPaid').hide();
            $('#paiddayCom').show();
            $('#paidweekCom').hide();
            $('#paidmonthCom').hide();
            $('#paidyearCom').hide();
        }else if(value==2){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').hide();
            $('#orderCancelWeekPicker').show();
            $('#orderCancelMonthPicker').hide();
            $('#orderCancelYearPicker').hide();
        }else if(value==3){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').hide();
            $('#orderCancelWeekPicker').hide();
            $('#orderCancelMonthPicker').show();
            $('#orderCancelYearPicker').hide();
        }else if(value==4){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').hide();
            $('#orderCancelWeekPicker').hide();
            $('#orderCancelMonthPicker').hide();
            $('#orderCancelYearPicker').show();
        }else if(value==5){
            $('#orderPagePaid').hide();
            $('#orderPagePend').hide();
            $('#orderPageAll').hide();
            $('#orderCancelAllTable').show();
            $('#orderCancelWeekPicker').hide();
            $('#orderCancelMonthPicker').hide();
            $('#orderCancelYearPicker').hide();
        }
    });

    $('.allOrderLink').click(function () {
        $('#allOrderLinkContain').addClass('activeTab');
        $('#pendOrderLinkContain').removeClass('activeTab');
        $('#paidOrderLinkContain').removeClass('activeTab');
        $('#cancelledOrderLinkContain').removeClass('activeTab');

        $('select#orderPageFilter').val('0');
        $('select#orderPageFilter').material_select();
        $('#orderPageAll').show();
        $('#orderPageCancel').hide();
        $('#orderAllTable').show();
        $('#orderPagePend').hide();
        $('#orderPagePaid').hide();
        $('#orderWeekPicker').hide();
        $('#orderMonthPicker').hide();
        $('#orderYearPicker').hide();
    });

    $('.pendOrderLink').click(function () {
        $('#allOrderLinkContain').removeClass('activeTab');
        $('#pendOrderLinkContain').addClass('activeTab');
        $('#paidOrderLinkContain').removeClass('activeTab');
        $('#cancelledOrderLinkContain').removeClass('activeTab');

        $('select#orderPendFilter').val('0');
        $('select#orderPendFilter').material_select();
        $('#orderPageAll').hide();
        $('#orderPageCancel').hide();
        $('#orderPendAllTable').show();
        $('#orderPagePend').show();
        $('#orderPagePaid').hide();
        $('#orderPendWeekPicker').hide();
        $('#orderPendMonthPicker').hide();
        $('#orderPendYearPicker').hide();
    });



    $('.paidOrderLink').click(function () {
        $('#allOrderLinkContain').removeClass('activeTab');
        $('#pendOrderLinkContain').removeClass('activeTab');
        $('#paidOrderLinkContain').addClass('activeTab');
        $('#cancelledOrderLinkContain').removeClass('activeTab');

        $('select#orderPaidFilter').val('0');
        $('select#orderPaidFilter').material_select();
        $('#orderPageAll').hide();
        $('#orderPageCancel').hide();
        $('#orderPaidAllTable').show();
        $('#orderPagePend').hide();
        $('#orderPagePaid').show();
        $('#orderPaidWeekPicker').hide();
        $('#orderPaidMonthPicker').hide();
        $('#orderPaidYearPicker').hide();
    });

    $('.cancelledOrderLink').click(function () {
        $('#allOrderLinkContain').removeClass('activeTab');
        $('#pendOrderLinkContain').removeClass('activeTab');
        $('#paidOrderLinkContain').removeClass('activeTab');
        $('#cancelledOrderLinkContain').addClass('activeTab');

        $('select#orderCancelFilter').val('0');
        $('select#orderCancelFilter').material_select();
        $('#orderPageAll').hide();
        $('#orderCancelAllTable').show();
        $('#orderPagePend').hide();
        $('#orderPagePaid').hide();
        $('#orderPageCancel').show();
        $('#orderCancelWeekPicker').hide();
        $('#orderCancelMonthPicker').hide();
        $('#orderCancelYearPicker').hide();
    });

});

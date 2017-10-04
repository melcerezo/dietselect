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

    $('.allLink').click(function () {
        $('#allLinkContain').addClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');

        $('select#orderFilter').val("0");

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
        $('#paidCom').hide();
        $('#dayCom').hide();
        $('#weekCom').hide();
        $('#monthCom').hide();
        $('#yearCom').hide();
    });
    $('.paidLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').addClass('activeTab');

        $('#allCom').hide();
        $('#pendCom').hide();
        $('#paidCom').show();
        $('#dayCom').hide();
        $('#weekCom').hide();
        $('#monthCom').hide();
        $('#yearCom').hide();
    });


});
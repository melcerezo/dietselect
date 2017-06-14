$(document).ready(function () {
    $('#allLinkContain').addClass('activeTab');

    $('.allLink').on('click',function () {

        // hide other tabs
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#ordPend').hide();
        $('#ordPaid').hide();

        // show pending tab
        $('#allLinkContain').addClass('activeTab');
        $('#ordAll').show();
    });
    $('.pendLink').on('click',function () {

        // hide other tabs
        $('#allLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');
        $('#ordAll').hide();
        $('#ordPaid').hide();

        // show pending tab
        $('#pendLinkContain').addClass('activeTab');
        $('#ordPend').show();
    });
    $('.paidLink').on('click',function () {

        // hide other tabs
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#ordAll').hide();
        $('#ordPend').hide();

        // show paid tab
        $('#paidLinkContain').addClass('activeTab');
        $('#ordPaid').show();
    });
});
$(document).ready(function() {
    $(document).on("click", "#logout-link", function () {
        $('form#logout').submit();
    });

    $('#allCom').show();
    $('#pendCom').hide();
    $('#paidCom').hide();

    $('#allLinkContain').addClass('activeTab');

    $('.allLink').click(function () {
        $('#allLinkContain').addClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');

        $('#allCom').show();
        $('#pendCom').hide();
        $('#paidCom').hide();
    });
    $('.pendLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').addClass('activeTab');
        $('#paidLinkContain').removeClass('activeTab');

        $('#allCom').hide();
        $('#pendCom').show();
        $('#paidCom').hide();
    });
    $('.paidLink').click(function () {
        $('#allLinkContain').removeClass('activeTab');
        $('#pendLinkContain').removeClass('activeTab');
        $('#paidLinkContain').addClass('activeTab');

        $('#allCom').hide();
        $('#pendCom').hide();
        $('#paidCom').show();
    });


});
$(document).ready(function () {
    $('.refundTab').on('click',function () {
        $('.refundTab').css('background-color','');
        $('.refundTab').find('span').css('color','');
        $(this).find('span').css('color','white');
        $(this).css('background-color','#f57c00');
        var id = $(this).attr('data-pay-reveal');
        $('.refundForm').hide();
        if(id=='bank'){
            $('#bankRefundPayment').show();
        }else if(id=='transfer'){
            $('#transferMoneyPayment').show();
        }
    });
});

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

    $('form#bankRefundForm').validate({
        rules: {
            acctNmbr: {
                required: true
            },
            acctName:{
                required:true
            }
        },
        messages: {
            acctNmbr:{
                required: 'Please enter account number!'
            },
            acctName:{
                required: 'Please enter your account name!'
            }
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('form#transferRefundForm').validate({
        rules: {
            transferName:{
                required:true
            }
        },
        messages: {
            transferName:{
                required: 'Please enter your full name!'
            }
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

});

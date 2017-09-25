$(document).ready(function () {
    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $('form#chefMessageSend').validate({
        rules:{
            chefMessageSelect:{
                required:true
            },
            chefMessage:{
                required:true
            }
        },
        messages:{
            chefMessageSelect:{
                required: "Enter a name for the receiver, please!"
            },
            chefMessage:{
                required: "Enter a message, please!"
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

    $('#createSubmit').click(function () {
        var msgVal = $('#chefMessage').val();
        // console.log(msgVal);
        // console.log($.trim(msgVal));

        if($.trim(msgVal).length==0){
            $('div.error-message').empty();
            $('div.error-message').append(
                '<span>' +
                'Enter a message, please!' +
                '</span>');
        }else if($.trim(msgVal).length>0 && $('#chefMessageSend').valid()){
            $('div.error-message').empty();
            $('form#chefMessageSend').submit();
        }
    });

    $('form.replyForm').each(function () {
        $(this).validate({
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
});
$(document).ready(function () {
    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $('form#foodieMessageSend').validate({
        rules:{
            foodieMessageSelect:{
                required:true
            },
            foodieMessage:{
                required:true
            }
        },
        messages:{
            foodieMessageSelect:{
                required: "Enter a name for the receiver, please!"
            },
            foodieMessage:{
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

    $('#foodieMessageSend').submit(function (event) {
        var msgVal = $('#foodieMessage').val();
        if($.trim('msgVal').length==0){
        console.log(msgVal);
            $('div.error-message').empty();
            $('div.error-message').append(
                '<span>' +
                    'Message is all spaces!' +
                '</span>');
            return false;
        }else if($.trim('msgVal').length>0 && $('#foodieMessageSend').valid()){
            $('div.error-message').empty();
            $('form#foodieMessageSend').submit();
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
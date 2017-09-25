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



    $('#createSubmit').click(function () {
        var msgVal = $('#foodieMessage').val();
        // console.log(msgVal);
        // console.log($.trim(msgVal));

        if($.trim(msgVal).length==0){
            $('div.error-message').empty();
            $('div.error-message').append(
                '<span>' +
                    'Enter a message, please!' +
                '</span>');
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
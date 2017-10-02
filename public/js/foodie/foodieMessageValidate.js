$(document).ready(function () {
    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $('form#foodieMessageSend').validate({
        rules:{
            foodieMessageSelect:{
                required:true
            },
            foodieSubject:{
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
            foodieSubject:{
                required: "Enter a subject, please!"
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
            $('#foodieMessage').rules('remove','required');
            $('form#foodieMessageSend').valid();
        }else if($.trim(msgVal).length>0 && $('#foodieMessageSend').valid()){
            $('div.error-message').empty();
            $('form#foodieMessageSend').submit();
        }
    });

    $('form#foodieMessageReply').validate({
            rules:{
                replyMessage:{
                    required:true
                }
            },
            messages:{
                replyMessage:{
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

    $('.replySubmit').click(function () {
        var msgVal = $('#replyMessage').val();
        // console.log(msgVal);
        // console.log($.trim(msgVal));

        if($.trim(msgVal).length==0){
            $('div.error-reply-message').empty();
            $('div.error-reply-message').append(
                '<span>' +
                    'Enter a message, please!' +
                '</span>');
        }else if($.trim(msgVal).length>0 && $('#foodieMessageReply').valid()){
            $('div.error-reply-message').empty();
            $('#replySubject').prop('disabled', false);
            $('form#foodieMessageReply').submit();
        }
    });

});
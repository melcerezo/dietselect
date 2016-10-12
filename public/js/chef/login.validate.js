$(document).ready(function(){
    $('div#verification-msg').on('click', 'a#close', function (){
        $('div#verification-msg').animate({
            height: 'toggle',
            opacity: 'toggle',
        });
    });

    $('form#login').validate({
        rules: {
            email: "required",
            password: "required"
        },
        //For custom messages
        messages: {
            email: {
                required: "Enter your email address, please!"
            },
            password: {
                required: "Enter your password, please!"
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
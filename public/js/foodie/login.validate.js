$(document).ready(function(){
    $('form#login').validate({
        rules: {
            email: "required",
            password: "required"
        },
        //For custom messages
        messages: {
            email: {
                required: "Enter your login email address, please!"
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
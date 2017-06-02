$(document).ready(function(){
    // $('div.input-field').on('focus', '#n-reg-mobile-num', function(){
    //     var url = $('#n-reg-mobile-num').val();
    //     if (url == '') {
    //         $('#n-reg-mobile-num').val('0');
    //     }
    // }).on('blur', '#n-reg-mobile-num', function(){
    //     var url = $('#n-reg-mobile-num').val();
    //     if (url == '0' || url.length < 7) {
    //         $('#n-reg-mobile-num').val('');
    //     }
    // });



    $('form#registration').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            mobile_number: {
                required: true,
                min: 9000000000,
                max: 9999999999,
                pattern: /^(9)\d{9}$/,
                digits: true
            },
            registration_email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#n-reg-pass"
            },
            user_agreement: "required"
        },
        //For custom messages
        messages: {
            first_name: {
                required: "Enter your first name, please!",
                minlength: "You sure you're named with one letter?"
            },
            last_name: {
                required: "Enter your last name, please!",
                minlength: "You sure you're named with one letter?"
            },
            mobile_number: {
                required: "Enter your mobile number, please!",
                min: "Enter a valid PH mobile number, please.",
                max: "Enter a valid PH mobile number, please.",
                digits: "Invalid mobile number length.",
                pattern: "Please follow the prescribed phone number format."
            },
            registration_email: {
                required: "Enter your email address, please!",
                email: "Enter a valid email address, please."
            },
            password: {
                required: "Enter your desired password, please!",
                minlength: "Sorry, password must be at least 6 characters."
            },
            password_confirmation: {
                required: "Confirm your password, please!",
                minlength: "Sorry, password must be at least 6 characters.",
                equalTo: "Sorry, passwords do not match."
            },
            user_agreement: {
                required: "Read and accept the User Agreement first, please."
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


    // ^(9)\d{9}$
});
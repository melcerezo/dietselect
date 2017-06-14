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


    $('#n-reg-pass').keyup(function()
    {
        $('#result').html(checkStrength($('#n-reg-pass').val()));
        console.log('type');
    });
    $('#n-reg-pass').blur(function () {
        if($('#n-reg-pass').val()==''){
            $('#result').empty();
        }
    });

    function checkStrength(password)
    {
        //initial strength
        var strength = 0;

        //if the password length is less than 6, return message.
        // if (password.length < 6) {
        //     $('#result').removeClass();
        //     $('#result').addClass('short');
        //     return 'Too short'
        // }

        //length is ok, lets continue.

        //if length is 8 characters or more, increase strength value
        if (password.length > 7) strength += 1;

        //if password contains both lower and uppercase characters, increase strength value
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1;

        //if it has numbers and characters, increase strength value
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1;

        //if it has one special character, increase strength value
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1;

        //if it has two special characters, increase strength value
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;

        //now we have calculated strength value, we can return messages

        //if value is less than 2
        if (strength < 2 )
        {
            $('#result').removeClass();
            $('#result').addClass('weak');
            return 'Weak';
        }
        else if (strength == 2 )
        {
            $('#result').removeClass();
            $('#result').addClass('good');
            return 'Good';
        }
        else
        {
            $('#result').removeClass();
            $('#result').addClass('strong');
            return 'Strong';
        }
    }

    // ^(9)\d{9}$
});
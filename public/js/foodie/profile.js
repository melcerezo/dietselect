$(document).ready(function() {
    $('#birthday').pickadate({
        // Buttons
        today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
        clear: 'Clear',
        close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

        //Formats
        format: 'yyyy-mm-dd',

        //Date limits
        max: Date.now(),

        //Dropdown selectors
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $('form#basic-profile').validate({
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
                digits: true
            }
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
                digits: "Enter a valid PH mobile number, please."
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
});
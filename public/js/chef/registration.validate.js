$(document).ready(function(){
    $('div.input-field').on('focus', '#n-reg-website', function(){
        var url = $('#n-reg-website').val();
        if (url == '') {
            $('#n-reg-website').val('http://');
        }
    }).on('blur', '#n-reg-website', function(){
        var url = $('#n-reg-website').val();
        if (url == 'http://' || url.length < 7) {
            $('#n-reg-website').val('');
        }
    });

    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9]+$/i.test(value);
    }, "Sorry, URL name must only contain letters and numbers.");

    $('form#registration').validate({
        rules: {
            name: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            mobile_number: {
                required: true,
                min: 9000000000,
                max: 9999999999,
                digits: true
            },
            website: {
                url: true,
                minlength: 10
            },
            url_name: {
                required: true,
                minlength: 5,
                alphanumeric: true
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
            partner_agreement: "required"
        },
        //For custom messages
        messages: {
            name: {
                required: "Enter your business/company name, please!",
                minlength: "Sorry, business name must be at least 5 characters."
            },
            email: {
                required: "Enter your email address, please!",
                email: "Enter a valid email address, please."
            },
            mobile_number: {
                required: "Enter your mobile number, please!",
                min: "Enter a valid PH mobile number, please.",
                max: "Enter a valid PH mobile number, please.",
                digits: "Enter a valid PH mobile number, please."
            },
            website: {
                url: "Enter a valid website link, please!",
                minlength: "Sorry, website link must be at least 10 characters."
            },
            url_name: {
                required: "Enter your desired URL name, please!",
                minlength: "Sorry, URL name must be at least 5 character."
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
            partner_agreement: {
                required: "Read and accept the Partner Agreement first, please."
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
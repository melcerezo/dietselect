jQuery(window).load(function() {
    $('#verification-modal').openModal({
        dismissible: false
    });

    var seconds = 60;
    var timer = setInterval(countdown, 1000);
    $('#n-request-code').toggle(false);
    function countdown(){
        seconds--;
        $('#n-timer').text(seconds + ' secs.');
        if(seconds <= 0) {
            clearInterval(timer);
            $('#n-timer-msg').toggle(false);
            $('#n-request-code').text('Request New SMS Code').toggle(true);
        }
    }
});

$(document).ready(function(){
    $('div.modal-footer').on("click", "a#submit", function () {
        $('form#verification').submit();
    });

    $("#verification-form").validate({
        rules: {
            verification_code: "required"
        },
        //For custom messages
        messages: {
            verification_code: {
                required: "Please enter your SMS Code."
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
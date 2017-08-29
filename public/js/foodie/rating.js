$(document).ready(function () {
    $('form.ratingForm').each(function(){
        $(this).validate({
            rules: {
                rating: {
                    required: true
                }
            },
            messages: {
                city: {
                    required: "Please provide a rating."
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
});
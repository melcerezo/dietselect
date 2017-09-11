$(document).ready(function () {

    if(from == 0){
        $('#pending').addClass('activeRate');
        $('.ratingTab').hide();
        $('#pendingRating').show();
    }else if(from == 1){
        $('#finished').addClass('activeRating');
        $('.ratingTab').hide();
        $('#finishedRating').show();
    }

    $('#pending').on('click',function () {

        // hide other tabs
        $('#finished').removeClass('activeRating');
        $('.ratingTab').hide();

        // show pending tab
        $('#pending').addClass('activeRating');
        $('#pendingRating').show();
    });
    $('#finished').on('click',function () {

        // hide other tabs
        $('#pending').removeClass('activeRating');
        $('.ratingTab').hide();

        // show pending tab
        $('#finished').addClass('activeRating');
        $('#finishedRating').show();
    });

    $('form.ratingForm').each(function(){
        $(this).validate({
            rules: {
                rating: {
                    required: true
                }
            },
            messages: {
                rating: {
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
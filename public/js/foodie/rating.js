$(document).ready(function () {

    if(from == 0){
        $('#pending').addClass('activeRate');
        $('.ratingTab').hide();
        $('#pendingRating').show();
    }else if(from == 1){
        $('#finished').addClass('activeRate');
        $('.ratingTab').hide();
        $('#finishedRating').show();
    }

    $('#pending').on('click',function () {

        // hide other tabs
        $('#finished').removeClass('activeRate');
        $('.ratingTab').hide();

        // show pending tab
        $('#pending').addClass('activeRate');
        $('#pendingRating').show();
    });
    $('#finished').on('click',function () {

        // hide other tabs
        $('#pending').removeClass('activeRate');
        $('.ratingTab').hide();

        // show pending tab
        $('#finished').addClass('activeRate');
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
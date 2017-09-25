$(document).ready(function () {
    // $('.dshPrfCrdCnt').mouseover(function () {
    //     $('#addCoverPhotoLink').empty();
    //     $('#addCoverPhotoLink').append('+Edit Photo');
    // });
    // $('.dshPrfCrdCnt').mouseleave(function () {
    //     $('#addCoverPhotoLink').empty();
    // });

    $('form#coverPhoto').validate({
        rules: {
            cover:{
                required:true,
                accept:true
            }
        },
        messages: {
            cover:{
                required: 'Please choose a cover photo!',
                accept: 'Images Only!'
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
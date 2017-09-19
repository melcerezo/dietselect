$(document).ready(function () {
   $('.simpleLink').hover(function () {
       if($(this).find('.deleteSimpleLink').css('visibility')=='hidden'){
           $(this).find('.deleteSimpleLink').css('visibility','visible');
       }else{
           $(this).find('.deleteSimpleLink').css('visibility','hidden');
       }
   });

    $('form#coverPhoto').validate({
        rules: {
            cover:{
                required:true,
                extension:true
            }
        },
        messages: {
            cover:{
                required: 'Please choose a cover photo!',
                extension: 'Images Only!'
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
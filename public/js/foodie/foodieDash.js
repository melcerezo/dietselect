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
                accept:"image/jpg,image/jpeg,image/png,image/gif"
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
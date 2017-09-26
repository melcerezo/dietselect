$(document).ready(function () {
   $('.simpleLink').hover(function () {
       if($(this).find('.deleteSimpleLink').css('visibility')=='hidden'){
           $(this).find('.deleteSimpleLink').css('visibility','visible');
       }else{
           $(this).find('.deleteSimpleLink').css('visibility','hidden');
       }
   });

    $.validator.addMethod('minImageWidth', function(value, element, minWidth) {
        return ($(element).data('imageWidth') || 0) > minWidth;
    }, function(minWidth, element) {
        var imageWidth = $(element).data('imageWidth');
        return (imageWidth)
            ? ("Your image's width must be greater than " + minWidth + "px")
            : "Selected file is not an image.";
    });

    $('form#coverPhoto').validate({
        rules: {
            cover:{
                required:true,
                accept:"image/jpg,image/jpeg,image/png,image/gif",
                minImageWidth:200
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

    var $submitBtn = $('#coverPhoto').find('input:submit'),
        $photoInput = $('#avatar'),
        $imgContainer = $('#imgContainer');

    $('#avatar').change(function() {
        $photoInput.removeData('imageWidth');
        $imgContainer.hide().empty();

        var file = this.files[0];

        if (file.type.match(/image\/.*/)) {
            // $submitBtn.attr('disabled', true);

            var reader = new FileReader();

            reader.onload = function() {
                var $img = $('<img />').attr({ src: reader.result });

                $img.on('load', function() {
                    $imgContainer.append($img).show();
                    var imageWidth = $img.width();
                    $photoInput.data('imageWidth', imageWidth);
                    if (imageWidth < 500) {
                        $imgContainer.hide();
                    } else {
                        $img.css({ width: '200px', height: '200px' });
                    }
                    // $submitBtn.attr('disabled', false);

                    validator.element($photoInput);
                });
            };

            reader.readAsDataURL(file);
        } else {
            validator.element($photoInput);
        }
    });



});
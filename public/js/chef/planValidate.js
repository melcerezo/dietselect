$(document).ready(function () {

    $('div.buyCard').hover(function () {
        if($(this).find('.card-content').find('.buyBtn').css('visibility')=='hidden'){
            $(this).find('.card-content').find('.buyBtn').css('visibility','visible');
        }else{
            $(this).find('.card-content').find('.buyBtn').css('visibility','hidden');
        }
    });

    $('.allName').click(function () {
        $('#currentContainer').hide();
        $('#upcomingContainer').hide();
        $('#allContainer').show();
    });
    $('.currentName').click(function () {
        $('#allContainer').hide();
        $('#upcomingContainer').hide();
        $('#currentContainer').show();
    });
    $('.upcomingName').click(function () {
        $('#allContainer').hide();
        $('#currentContainer').hide();
        $('#upcomingContainer').show();
    });


    $.validator.addMethod('minImageWidth', function(value, element, minWidth) {
        return ($(element).data('imageWidth') || 0) > minWidth;
    }, function(minWidth, element) {
        var imageWidth = $(element).data('imageWidth');
        return (imageWidth)
            ? ("Your image's width must be greater than " + minWidth + "px")
            : "Selected file is not an image.";
    });

    $('form#createPlanForm').validate({
        rules:{
            plan_name:{
                required:true
            },
            calories:{
                required:true,
                number:true,
                min:0
            },
            description:{
                required:true
            },
            category:{
                required:true
            },
            planPic:{
                required:true,
                accept:true,
                minImageWidth:200
            },
            price:{
                required:true,
                number:true,
                min:0
            }
        },
        messages:{
            plan_name:{
                required: "Enter a plan name, please!"
            },
            calories:{
                required: "Enter an amount of calories, please!",
                min: "No negative numbers allowed!"
            },
            description:{
                required: 'Please enter a description!'
            },
            category:{
                required: 'Please select a category!'
            },
            planPic:{
                required: 'Please upload picture for the plan!',
                accept: 'Images only!'
            },
            price:{
                required: "Enter a price, please!"
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

    var $photoInput = $('#planPic'),
        $imgContainer = $('#imgContainer');

    $('#mealPic').change(function() {
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
                    if (imageWidth < 200) {
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
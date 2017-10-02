$(document).ready(function() {
    $('#basicProfileLinkContainer').addClass('activePrfLink');
    $('#basic-profile-container').show();

    $(document).on('click','#basicProfileLink', function () {
        $('#addressLinkContainer,#allergiesLinkContainer,#preferenceLinkContainer').removeClass('activePrfLink');
        $('#basicProfileLinkContainer').addClass('activePrfLink');
        $('#basic-profile-container').show();
        $('#allergies-container,#addresses-container,#food-preferences-container').hide();
    });
    $('div.input-field').on('focus', '#website', function(){
        var url = $('#website').val();
        if (url == '') {
            $('#website').val('http://');
        }
    }).on('blur', '#website', function(){
        var url = $('#website').val();
        if (url == 'http://' || url.length < 7) {
            $('#website').val('');
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

    $('form#basic-profile').validate({
        rules: {
            company_name: {
                required: true,
                minlength: 2
            },
            // mobile_number: {
            //     required: true,
            //     min: 9000000000,
            //     max: 9999999999,
            //     digits: true
            // },
            email: {
                required: true,
                email: true
            },
            website: {
                url: true,
                minlength: 10
            },
            avatar:{
                accept: true,
                minImageWidth:200
            }

        },
        //For custom messages
        messages: {
            company_name: {
                required: "Enter your company name, please!",
                minlength: "You sure you're named with one letter?"
            },
            // mobile_number: {
            //     required: "Enter your company number, please!",
            //     min: "Enter a valid PH mobile number, please.",
            //     max: "Enter a valid PH mobile number, please.",
            //     digits: "Enter a valid PH mobile number, please."
            // },
            email: {
                required: "Enter your email address, please!",
                email: "Enter a valid email address, please."
            },
            website: {
                url: "Enter a valid website link, please!",
                minlength: "Sorry, website link must be at least 10 characters."
            },
            avatar:{
                accept: "Images only!"
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

    var $photoInput = $('#avatar'),
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
                    if (imageWidth < 200) {
                        $('#avatarBefore').show();
                        $imgContainer.hide();
                    } else {
                        $('#avatarBefore').hide();
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

    $('#prfSvBtn').on('click',function () {
        var fileInput = $('#basic-profile').find("input[type=file]")[0],
            file = fileInput.files && fileInput.files[0];
        console.log(file);
        if (!(file)) {
            $('#avatar').rules('remove', 'minImageWidth');
        }

        if($('#basic-profile').valid()){
            $('#basic-profile').submit();
        }

    });

});
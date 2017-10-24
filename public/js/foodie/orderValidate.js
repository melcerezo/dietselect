$(document).ready(function () {

    $('.payTab').on('click',function () {
        $('.payTab').css('background-color','');
        $('.payTab').find('span').css('color','');
        $(this).find('span').css('color','white');
        $(this).css('background-color','#f57c00');
        var id = $(this).attr('data-pay-reveal');
       $('.payForm').hide();
        if(id=='bank'){
            $('#bankPayment').show();
        }else if(id=='paypal'){
            $('#payPalPayment').show();
        }else if(id=='gcash'){
            $('#gcashPayment').show();
        }

    });

    $('#datePay').pickadate({
        // Buttons
        today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
        clear: 'Clear',
        close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

        //Formats
        format: 'yyyy-mm-dd',

        //Date limits
        max: Date.now(),

        //Dropdown selectors
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $('#gcDatePay').pickadate({
        // Buttons
        today: '<i class="fa fa-calendar-check-o" aria-hidden="true"></i>',
        clear: 'Clear',
        close: '<i class="fa fa-check-circle" aria-hidden="true"></i>',

        //Formats
        format: 'yyyy-mm-dd',

        //Date limits
        max: Date.now(),

        //Dropdown selectors
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    $('#bankPayForm').submit(function () {
        $('#loadWait').show();
        if(!$('#bankPayForm').valid()){
            $('#loadWait').hide();
        }
    });
    $('#gcPayForm').submit(function () {
        $('#loadWait').show();
        if(!$('#gcPayForm').valid()){
            $('#loadWait').hide();
        }
    });

    $('#receipt').on('keydown keyup', function(e){
        if ($(this).val().length >= 20
            && e.keyCode != 46 // delete
            && e.keyCode != 8 // backspace
            && e.keyCode != 9 // tab
        ) {
            e.preventDefault();
            // $(this).val(100);
        }else{
            if(e.shiftKey && ((e.keyCode >=48 && e.keyCode <=57)
                || (e.keyCode >=186 &&  e.keyCode <=222))){
                // Ensure that it is a number and stop the Special chars
                e.preventDefault();
            }
            else if ((e.shiftKey || e.ctrlKey) && (e.keyCode > 34 && e.keyCode < 40)){
                // let it happen, don't do anything
            }
            else{
                // Allow only backspace , delete, numbers
                if (e.keyCode == 9 || e.keyCode == 46 || e.keyCode == 8 || e.keyCode == 39 ||e.keyCode == 37
                    || (e.keyCode >=48 && e.keyCode <=57) || (e.keyCode >64 &&  e.keyCode <91)) {
                    // let it happen, don't do anything
                }
                else {
                    // Ensure that it is a number and stop the key press
                    e.preventDefault();
                }
            }
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

    $('form#bankPayForm').validate({
        rules: {
            receipt_number: {
                required: true,
                minlength:8,
                maxlength: 20
            },
            datePay:{
                required:true
            },
            image:{
                required:true,
                accept: true,
                minImageWidth: 200
            }
        },
        messages: {
            receipt_number:{
                required: 'Please enter receipt number!',
                minlength: 'Reference Number format is incorrect!',
                maxlength: 'Reference Number is too big!'
            },
            datePay:{
                required: 'Please enter the date you paid!'
            },
            image:{
                required: 'Please upload your proof of payment!',
                accept: 'Images only!'
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

    var $photoInput = $('#image'),
        $imgContainer = $('#bankContainer');

    $('#image').change(function() {
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

    $('form#gcPayForm').validate({
        rules: {
            gcRefNmbr: {
                required: true,
                minlength:8,
                maxlength: 16
            },
            gcDatePay:{
                required:true
            },
            gcPic:{
                required:true,
                accept:true,
                minImageWidth: 200
            }
        },
        messages: {
            gcRefNmbr:{
                required: 'Please enter receipt number!',
                minlength: 'Reference Number format is incorrect!',
                maxlength: 'Reference Number is too big!'
            },
            gcDatePay:{
                required: 'Please enter the date you paid!'
            },
            gcPic:{
                required: 'Please upload your proof of payment!',
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

    var $gcashInput = $('#gcPic'),
        $gcashContainer = $('#gcashContainer');

    $('#gcPic').change(function() {
        $gcashInput.removeData('imageWidth');
        $gcashContainer.hide().empty();

        var file = this.files[0];

        if (file.type.match(/image\/.*/)) {
            // $submitBtn.attr('disabled', true);

            var reader = new FileReader();

            reader.onload = function() {
                var $img = $('<img />').attr({ src: reader.result });

                $img.on('load', function() {
                    $gcashContainer.append($img).show();
                    var imageWidth = $img.width();
                    $gcashInput.data('imageWidth', imageWidth);
                    if (imageWidth < 500) {
                        $gcashContainer.hide();
                    } else {
                        $img.css({ width: '200px', height: '200px' });
                    }
                    // $submitBtn.attr('disabled', false);

                    validator.element($gcashInput);
                });
            };

            reader.readAsDataURL(file);
        } else {
            validator.element($gcashInput);
        }
    });


    $('form#cancelOrderForm').validate();


    $('input[type=radio][name=cancelReason]').change(function () {
        if($(this).val()==4){
            $('#otherReasonContainer').show();
            $('#otherReason').rules('add', {
                required: true,
                messages:{
                    required: "Please enter a reason."
                }
            });
        }else{
            $('#otherReasonContainer').hide();
            $('#otherReason').rules('remove', 'required');
        }
    });

    $('#cancelOrderSubmit').click(function () {
        // $('#loadWait').show();
    })
    
});
$(document).ready(function () {
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
    });
    $('#gcPayForm').submit(function () {
        $('#loadWait').show();
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
                required:true
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
                required: 'Please upload your proof of payment!'
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
                required:true
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
                required: 'Please upload your proof of payment!'
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
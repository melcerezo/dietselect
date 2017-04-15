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
    $('form#bankPayForm').validate({
        rules: {
            receipt_number: {
                required: true
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
                required: 'Please enter receipt number!'
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
});
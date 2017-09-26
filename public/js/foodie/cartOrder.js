$(document).ready(function(){
    $('#orderButton').on('click', function () {
        $('#loadWait').show();
    });
    $('#removeButton').on('click', function () {
        $('#loadWait').show();
    });

    $('form.updateQtyForm').each(function () {
        $(this).validate({
            rules:{
                qty:{
                    required: true,
                    min:1
                }
            },
            messages:{
                qty:{
                    required: "Enter a valid quantity!",
                    min: "Enter a valid quantity!"
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
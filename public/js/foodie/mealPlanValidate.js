$(document).ready(function () {

    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $('form.editMeal').each(function () {
        console.log($(this).attr('id'));
        $(this).validate({
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
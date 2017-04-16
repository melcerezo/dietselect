$(document).ready(function () {

    // $(document).on('click','.modal-trigger',function (e) {
    //     e.preventDefault();
    //     $('form#'+subId).submit();
    //     var id = $(this).attr('id');
    //     inform(id);
    //     // var subId=$(this).attr('data-form-id');
    // });


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

// function inform(fId){
//     $('span#c'+fId).append('customized');
//     // console.log('span#c'+fId);
// }
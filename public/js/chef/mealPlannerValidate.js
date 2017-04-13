$(document).ready(function () {

    $(window).load(function () {
        $('form.editMeal').each(function () {
            console.log($(this).attr('id'));
            $(this).validate({
                rules: {
                    description: {
                        required: true
                    },
                    main_ingredient: {
                        required: true
                    }
                },
                //For custom messages
                messages: {
                    description: {
                        required: "Enter your first name, please!",
                        minlength: "You sure you're named with one letter?"
                    },
                    main_ingredient: {
                        required: "Enter your last name, please!"
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
        $('select.updateIngredSelect').each(function () {
            $(this).rules('add', {
                required: true
            });
        });
        $('input.ingredAuto').each(function () {
            $(this).rules('add', {
                required: true
            });
        });

    });

        $('#ingredientContainer').on("click","#ingredAdd",function (){

        });

});

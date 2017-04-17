$(document).ready(function () {
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
});
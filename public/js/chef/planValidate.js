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
                required:true
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
                required: 'Please upload picture for the plan!'
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
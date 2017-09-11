$(document).ready(function () {
    $(document).on('click','.data-trigger',function () {
        var $this=$(this);
        var mealDataID= $this.attr('data-meal-active');
        $('.plSlMlInf').hide();
        $('.plSlMlInfDef').hide();
        $(mealDataID).show();
    });
    $(document).on('click','#plSlMlOrd',function () {
        window.location.href=$orderRoute;
    });
    $(document).on('click','#plSlMlCst',function () {
        window.location.href=$customizeRoute;
    });


    $('.mlCnt').each(function () {
        if(lockPlan==0){
            var day = $(this).attr('data-day');
            var mealType = $(this).attr('data-meal-type');
            if ($(this).text().trim() == "") {
                $(this).append('<a href="#chooseModal' + day + mealType + '" class="chooseModalLink modal-trigger">+Add Meal</a>');
                $(this).append('<div id="chooseModal' + day + mealType + '" class="chooseModalCls modal">' +
                    '<div class="modal-content">' +
                    '<span style="margin-right: 10px;"><button data-day="' + day + '" data-meal-type="' + mealType + '" data-target="createMeal" class="orange darken-1 createMealLink modal-trigger btn waves-effect waves-light">Create</button></span>' +
                    '<button data-day="' + day + '" data-meal-type="' + mealType + '" data-target="chooseMeal" class="orange darken-1 chooseMealLink modal-trigger btn waves-effect waves-light">Choose</button>' +
                    '</div>' +
                    '</div>');
            }
        }
    });


    $('.createMealLink').on('click',function () {
        var mealDay = $(this).attr('data-day');
        var mealType=$(this).attr('data-meal-type');
//                $('option:selected','select[name="day"]').removeAttr('selected');
        switch(mealDay){
            case 'MO':
                $('#dayCreate').val("MO");
                $('#dayName').empty();
                $('#dayName').append("Monday");
                break;
            case 'TU':
                $('#dayCreate').val("TU");
                $('#dayName').empty();
                $('#dayName').append("Tuesday");
                console.log($('#day').val());
                break;
            case 'WE':
                $('#dayCreate').val("WE");
                $('#dayName').empty();
                $('#dayName').append("Wednesday");
                console.log($('#day').val());
                break;
            case 'TH':
                $('#dayCreate').val("TH");
                $('#dayName').empty();
                $('#dayName').append("Thursday");
                console.log($('#day').val());
                break;
            case 'FR':
                $('#dayCreate').val("FR");
                $('#dayName').empty();
                $('#dayName').append("Friday");
                console.log($('#day').val());
                break;
            case 'SA':
                $('#dayCreate').val("SA");
                $('#dayName').empty();
                $('#dayName').append("Saturday");
                console.log($('#day').val());
                break;
        }

        switch(mealType){
            case 'Breakfast':
                $('#meal_typeCreate').val("Breakfast");
                $('#createMealTypeName').empty();
                $('#createMealTypeName').append("Breakfast");
                break;
            case 'MorningSnack':
                $('#meal_typeCreate').val("MorningSnack");
                $('#createMealTypeName').empty();
                $('#createMealTypeName').append("Morning Snack");
                console.log($('#meal_type').val());
                break;
            case 'Lunch':
                $('#meal_typeCreate').val("Lunch");
                $('#createMealTypeName').empty();
                $('#createMealTypeName').append("Lunch");
                console.log($('#meal_type').val());
                break;
            case 'AfternoonSnack':
                $('#meal_typeCreate').val("AfternoonSnack");
                $('#createMealTypeName').empty();
                $('#createMealTypeName').append("Afternoon Snack");
                console.log($('#meal_type').val());
                break;
            case 'Dinner':
                $('#meal_typeCreate').val("Dinner");
                $('#createMealTypeName').empty();
                $('#createMealTypeName').append("Dinner");
                console.log($('#meal_type').val());
                break;
        }
    });

    $('#addMealButton').on('click',function () {
        $('#description').val($('#mealName').val());
        console.log($('#mealName').val());
    });


    function mealAjax(){
        return $.ajax({
            url: '/chef/plan/getMealJson',
            dataType: 'json'
        });
    }

    $('.createChooseMealLink').on('click', function () {
        $(".chooseMdlTbl").closeModal();
    });

    $('.createMealLink').on('click',function () {
        // var mealDay = $(this).attr('data-day');
        // var mealType=$(this).attr('data-meal-type');
        $(".chooseModalCls").closeModal();
    });

    $('.chooseMealLink').on('click', function () {
        var select=$('#mealChoiceSelect');
        var mealDay = $(this).attr('data-day');
        var mealType=$(this).attr('data-meal-type');
        $("#chooseModal"+mealDay+mealType).closeModal();
        $('#mealsTableBody').empty();
//                $('option:selected','select[name="day"]').removeAttr('selected');
        switch(mealDay){
            case 'MO':
                $('#dayChoose').val("MO");
                $('#dayNameChoose').empty();
                $('#dayNameChoose').append("Monday");
                break;
            case 'TU':
                $('#dayChoose').val("TU");
                $('#dayNameChoose').empty();
                $('#dayNameChoose').append("Tuesday");
                console.log($('#day').val());
                break;
            case 'WE':
                $('#dayChoose').val("WE");
                $('#dayNameChoose').empty();
                $('#dayNameChoose').append("Wednesday");
                console.log($('#day').val());
                break;
            case 'TH':
                $('#dayChoose').val("TH");
                $('#dayNameChoose').empty();
                $('#dayNameChoose').append("Thursday");
                console.log($('#day').val());
                break;
            case 'FR':
                $('#dayChoose').val("FR");
                $('#dayNameChoose').empty();
                $('#dayNameChoose').append("Friday");
                console.log($('#day').val());
                break;
            case 'SA':
                $('#dayChoose').val("SA");
                $('#dayNameChoose').empty();
                $('#dayNameChoose').append("Saturday");
                console.log($('#day').val());
                break;
        }

        switch(mealType){
            case 'Breakfast':
                $('#meal_typeChoose').val("Breakfast");
                $('#mealTypeChoose').empty();
                $('#mealTypeChoose').append("Breakfast");
                break;
            case 'MorningSnack':
                $('#meal_typeChoose').val("MorningSnack");
                $('#mealTypeChoose').empty();
                $('#mealTypeChoose').append("Morning Snack");
                console.log($('#meal_type').val());
                break;
            case 'Lunch':
                $('#meal_typeChoose').val("Lunch");
                $('#mealTypeChoose').empty();
                $('#mealTypeChoose').append("Lunch");
                console.log($('#meal_type').val());
                break;
            case 'AfternoonSnack':
                $('#meal_typeChoose').val("AfternoonSnack");
                $('#mealTypeChoose').empty();
                $('#mealTypeChoose').append("Afternoon Snack");
                console.log($('#meal_type').val());
                break;
            case 'Dinner':
                $('#meal_typeChoose').val("Dinner");
                $('#mealTypeChoose').empty();
                $('#mealTypeChoose').append("Dinner");
                console.log($('#meal_type').val());
                break;
        }
        var meals=mealAjax();
        meals.done(function (response) {
            var mealData = response;
            console.log(select);
            $.each(mealData,function (index) {
                var str = mealData[index].main_ingredient;
                str= str.toLowerCase().replace(/\b[a-z]/g, function (letter) {
                   return letter.toUpperCase();
                });

                var tableRow = '<tr class="mealLink" data-meal-id="'+mealData[index].id+'">' +
                        '<td>'+mealData[index].description+'</td>' +
                        '<td>'+str+'</td>' +
                        '<td>'+mealData[index].calories+'</td>' +
                        '<td>'+mealData[index].carbohydrates+'</td>' +
                        '<td>'+mealData[index].protein+'</td>' +
                        '<td>'+mealData[index].fat+'</td>' +
                    '</tr>';
                $(tableRow).appendTo('#mealsTableBody');
                // var option='<option value="'+mealData[index].id+'">'+mealData[index].description+'</option>';
            });

           // $('#mealChoiceSelect').material_select();
        });
    });

    $(document).on('click','.mealLink',function () {
        $('.mealLink').removeClass('chosen');
        $(this).addClass('chosen');
        var meal_id = $(this).attr('data-meal-id');
        $('#meal_idChoose').val(meal_id);
    });

    $(document).on('click','.deleteMealPlanButton',function () {
        var mealDay = $(this).attr('data-day');
        var mealType=$(this).attr('data-meal-type');
        var mealPlanId=$(this).attr('data-mealplan-id');

        $('#deleteMealPlanId').val(mealPlanId);

        switch(mealDay){
            case 'MO':
                $('#formDay').empty();
                $('#formDay').append("Monday");
                $('#dayDelete').empty();
                $('#dayDelete').append("Monday");
                break;
            case 'TU':
                $('#formDay').empty();
                $('#formDay').append("Tuesday");
                $('#dayDelete').empty();
                $('#dayDelete').append("Tuesday");
                break;
            case 'WE':
                $('#formDay').empty();
                $('#formDay').append("Wednesday");
                $('#dayDelete').empty();
                $('#dayDelete').append("Wednesday");
                break;
            case 'TH':
                $('#formDay').empty();
                $('#formDay').append("Thursday");
                $('#dayDelete').empty();
                $('#dayDelete').append("Thursday");
                break;
            case 'FR':
                $('#formDay').empty();
                $('#formDay').append("Friday");
                $('#dayDelete').empty();
                $('#dayDelete').append("Friday");
                break;
            case 'SA':
                $('#formDay').empty();
                $('#formDay').append("Saturday");
                $('#dayDelete').empty();
                $('#dayDelete').append("Saturday");
                break;
        }

        switch(mealType){
            case 'Breakfast':
                $('#formMealType').empty();
                $('#formMealType').append("Breakfast");
                $('#mealTypeDelete').empty();
                $('#mealTypeDelete').append("Breakfast");
                break;
            case 'MorningSnack':
                $('#formMealType').empty();
                $('#formMealType').append("Morning Snack");
                $('#mealTypeDelete').empty();
                $('#mealTypeDelete').append("Morning Snack");
                break;
            case 'Lunch':
                $('#formMealType').empty();
                $('#formMealType').append("Lunch");
                $('#mealTypeDelete').empty();
                $('#mealTypeDelete').append("Lunch");
                break;
            case 'AfternoonSnack':
                $('#formMealType').empty();
                $('#formMealType').append("Afternoon Snack");
                $('#mealTypeDelete').empty();
                $('#mealTypeDelete').append("Afternoon Snack");
                break;
            case 'Dinner':
                $('#formMealType').empty();
                $('#formMealType').append("Dinner");
                $('#mealTypeDelete').empty();
                $('#mealTypeDelete').append("Dinner");
                break;
        }
    });

});
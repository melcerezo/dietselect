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


    $('.tdCell').each(function () {
        var day=$(this).attr('data-day');
        var mealType=$(this).attr('data-meal-type');
        if($(this).text().trim()==""){
            $(this).append('<a href="#chooseModal'+day+mealType+'" class="chooseModalLink modal-trigger">+Add Meal</a>');
            $(this).append('<div id="chooseModal'+day+mealType+'" class="modal">'+
                                '<div class="modal-content">'+
                                   '<div class="chseMdlBtnCnt">'+
                                        '<button data-day="'+day+'" data-meal-type="'+mealType+'" data-target="createMeal" class="createMealLink modal-trigger btn waves-effect waves-light">Create New Meal</button>'+
                                   '</div>'+
                                   '<div class="chseMdlBtnCnt">'+
                                        '<button data-day="'+day+'" data-meal-type="'+mealType+'" data-target="chooseMeal" class="chooseMealLink modal-trigger btn waves-effect waves-light">Pick From Existing Meals</button>'+
                                   '</div>'+
                                '</div>'+
                            '</div>');
        }
    });


    $('.createMealLink').on('click',function () {
        var mealDay = $(this).attr('data-day');
        var mealType=$(this).attr('data-meal-type');
//                $('option:selected','select[name="day"]').removeAttr('selected');
        switch(mealDay){
            case 'MO':
                $('#day').val("MO");
                $('#dayName').empty();
                $('#dayName').append("Monday");
                break;
            case 'TU':
                $('#day').val("TU");
                $('#dayName').empty();
                $('#dayName').append("Tuesday");
                console.log($('#day').val());
                break;
            case 'WE':
                $('#day').val("WE");
                $('#dayName').empty();
                $('#dayName').append("Wednesday");
                console.log($('#day').val());
                break;
            case 'TH':
                $('#day').val("TH");
                $('#dayName').empty();
                $('#dayName').append("Thursday");
                console.log($('#day').val());
                break;
            case 'FR':
                $('#day').val("FR");
                $('#dayName').empty();
                $('#dayName').append("Friday");
                console.log($('#day').val());
                break;
            case 'SA':
                $('#day').val("SA");
                $('#dayName').empty();
                $('#dayName').append("Saturday");
                console.log($('#day').val());
                break;
        }

        switch(mealType){
            case 'Breakfast':
                $('#meal_type').val("Breakfast");
                $('#mealType').empty();
                $('#mealType').append("Breakfast");
                break;
            case 'MorningSnack':
                $('#meal_type').val("MorningSnack");
                $('#mealType').empty();
                $('#mealType').append("Morning Snack");
                console.log($('#meal_type').val());
                break;
            case 'Lunch':
                $('#meal_type').val("Lunch");
                $('#mealType').empty();
                $('#mealType').append("Lunch");
                console.log($('#meal_type').val());
                break;
            case 'AfternoonSnack':
                $('#meal_type').val("AfternoonSnack");
                $('#mealType').empty();
                $('#mealType').append("Afternoon Snack");
                console.log($('#meal_type').val());
                break;
            case 'Dinner':
                $('#meal_type').val("Dinner");
                $('#mealType').empty();
                $('#mealType').append("Dinner");
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

    $('.chooseMealLink').on('click', function () {
        var select=$('#mealChoiceSelect');
        var mealDay = $(this).attr('data-day');
        var mealType=$(this).attr('data-meal-type');
        $("#chooseModal"+mealDay+mealType).closeModal();
//                $('option:selected','select[name="day"]').removeAttr('selected');
        switch(mealDay){
            case 'MO':
                $('#day').val("MO");
                $('#dayName').empty();
                $('#dayName').append("Monday");
                break;
            case 'TU':
                $('#day').val("TU");
                $('#dayName').empty();
                $('#dayName').append("Tuesday");
                console.log($('#day').val());
                break;
            case 'WE':
                $('#day').val("WE");
                $('#dayName').empty();
                $('#dayName').append("Wednesday");
                console.log($('#day').val());
                break;
            case 'TH':
                $('#day').val("TH");
                $('#dayName').empty();
                $('#dayName').append("Thursday");
                console.log($('#day').val());
                break;
            case 'FR':
                $('#day').val("FR");
                $('#dayName').empty();
                $('#dayName').append("Friday");
                console.log($('#day').val());
                break;
            case 'SA':
                $('#day').val("SA");
                $('#dayName').empty();
                $('#dayName').append("Saturday");
                console.log($('#day').val());
                break;
        }

        switch(mealType){
            case 'Breakfast':
                $('#meal_type').val("Breakfast");
                $('#mealType').empty();
                $('#mealType').append("Breakfast");
                break;
            case 'MorningSnack':
                $('#meal_type').val("MorningSnack");
                $('#mealType').empty();
                $('#mealType').append("Morning Snack");
                console.log($('#meal_type').val());
                break;
            case 'Lunch':
                $('#meal_type').val("Lunch");
                $('#mealType').empty();
                $('#mealType').append("Lunch");
                console.log($('#meal_type').val());
                break;
            case 'AfternoonSnack':
                $('#meal_type').val("AfternoonSnack");
                $('#mealType').empty();
                $('#mealType').append("Afternoon Snack");
                console.log($('#meal_type').val());
                break;
            case 'Dinner':
                $('#meal_type').val("Dinner");
                $('#mealType').empty();
                $('#mealType').append("Dinner");
                console.log($('#meal_type').val());
                break;
        }
        var meals=mealAjax();
        meals.done(function (response) {
            var mealData = response;
            console.log(select);
            $.each(mealData,function (index) {
                var tableRow = '<tr class="mealLink" data-meal-id="'+mealData[index].id+'">' +
                        '<td>'+mealData[index].description+'</td>' +
                        '<td>'+mealData[index].main_ingredient+'</td>' +
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
        $('#meal_id').val(meal_id);
    });

});
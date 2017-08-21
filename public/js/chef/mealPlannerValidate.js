$(document).ready(function () {


    function ingredAjax($valType){
        return $.ajax({
            url: '/chef/' + $valType + '/validateIngredJson',
            dataType:'json'
        });
    }

    $("select.ingredChefAdd").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $('.createB').click(function () {
        $('#loadWait').show();
        var form=$(this).closest("form");
        var errCount = 0;
        if($('#description').val()==""){
            errCount+=1;
            $('#loadWait').hide();
            $('#errorDescription').empty();
            $('#formError').empty();
            $errorsDesc="<span style='font-size:12px;color:#ff0000;'>Please add in a description!</span>";
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#errorDescription').append($errorsDesc);
            $('#formError').append($errorForm);
        }else{
            errCount-=1;
            $('#errorDescription').empty();
            $('#formError').empty();
        }
        if($('#main_ingredient').val()==""){
            errCount+=1;
            $('#loadWait').hide();
            $('#errorMainIngredient').empty();
            $('#formError').empty();
            $errorsMainIngredient="<span style='font-size:12px;color:#ff0000;'>Please choose a main ingredient!</span>";
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#errorMainIngredient').append($errorsMainIngredient);
            $('#formError').append($errorForm);
        }else{
            errCount-=1;
            $('#errorMainIngredient').empty();
            $('#formError').empty();
        }
        if(counter<1){
            errCount+=1;
            $('#loadWait').hide();
            $('#ingredError').empty();
            $errorCounter="<span style='font-size:12px;color:#ff0000;'>Please add at least one ingredient!</span>";
            $('#ingredError').append($errorCounter);
        }else{
            errCount-=1;
            $('#ingredError').empty();
        }


        console.log(errCount);
        var ingredSelect=form.find("#ingredientContainer").children();
        var ingredFind=ingredSelect.children('.ingredients');
        // console.log(ingredFind);
        var ingredCountz=ingredFind.length;
        // console.log(ingredCountz);
        var matchData=0;
        $(ingredFind).each(function () {
            var ingredIn=$(this).find('input.autocomplete');
            var $thisVal=ingredIn.val();
            // console.log($thisVal);
            var $error=ingredIn.attr('data-error');
            var $errorContainer=ingredIn.parents().eq(1).find($error);
            var $thisSelect=ingredIn.parents().eq(2).find('.ingredChefSelect').children('.addSelectIngred');
            var $selectThis=$thisSelect.children('.ingredChefAdd').children('.ingredChefAdd');
            var $errSel=$selectThis.attr('data-error');
            var $errorSelContainer=ingredIn.parents().eq(2).find($errSel);
            var $valType=$("option:selected",$selectThis).val().toLowerCase();
            console.log($errSel);
            if($valType==''){
                errCount+=1;
                $('#loadWait').hide();
                $errorContainer.empty();
                $errorContainer.append("Please choose ingredient type");
            }else{
                errCount-=1;
                $errorContainer.empty();
            }
            if($thisVal!=""){
                if($valType=="fruits/fruit juices"){
                    $valType='fruits';
                }else if($valType=='carbohydrates(grains, pasta)'){
                    $valType='carbohydrates(grains,pasta)';
                }else if($valType=='fish/shellfish'){
                    $valType='fish';
                }else if($valType=='dairy,egg'){
                    $valType='dairy,eggs';
                }else if($valType=='soups,sauces,gravies'){
                    $valType='soups,sauces,gravy';
                }
                var $ingredientAuto=ingredAjax($valType);
                $ingredientAuto.done(function(response){
                    // console.log('This is in ajax');
                    var valData=response;
                    for(var i = 0,l=valData.length;i<l;i++){
                        var ingred= valData[i].name;
                        if($thisVal==ingred){
                            matchData+=1;
                            $errorContainer.empty();
                        }
                    }
                    if(!matchData){
                        $('#loadWait').hide();
                        $errorContainer.empty();
                        $errorContainer.append("The listed ingredient is not found");
                    }
                    if(matchData==ingredCountz&&errCount==0){
                        form.unbind('submit').submit();
                    }
                });
            }else{
                $errorContainer.empty();
                $errorSelContainer.empty();
                $errorSelContainer.append('Please select ingredient type');
                $errorContainer.append("Please enter an ingredient");
            }
        });
    });

    $('button.updateB').click(function () {
        var form=$(this).closest("form");

        console.log(form);
        var ingredSelect=form.find("#ingredSelect").children();
        var ingredFind=ingredSelect.children('.ingredSelectAdd');
        var ingredCountz=ingredFind.length;
        console.log(ingredCountz);
        var matchData=0;
        $('#loadWait').show();
        $(ingredFind).each(function () {
            var ingredIn=$(this).find('input.autocomplete');
            var $thisVal=ingredIn.val();
            var $error=ingredIn.attr('data-error');
            var $errorContainer=ingredIn.parents().eq(1).find($error);
            if($thisVal!=""){
                var $thisSelect=ingredIn.parents().eq(1).find('select.updateIngredSelect');
                var $valType=$("option:selected",$thisSelect).val().toLowerCase();
                if($valType=="fruits/fruit juices"){
                    $valType='fruits';
                }else if($valType=='carbohydrates(grains, pasta)'){
                    $valType='carbohydrates(grains,pasta)';
                }else if($valType=='fish/shellfish'){
                    $valType='fish';
                }else if($valType=='dairy,egg'){
                    $valType='dairy,eggs';
                }else if($valType=='soups,sauces,gravies'){
                    $valType='soups,sauces,gravy';
                }
                var $ingredientAuto=ingredAjax($valType);
                $ingredientAuto.done(function(response){
                    // console.log('This is in ajax');
                    var valData=response;
                    for(var i = 0,l=valData.length;i<l;i++){
                        var ingred= valData[i].name;
                        if($thisVal==ingred){
                            matchData+=1;
                            $errorContainer.empty();
                        }
                    }
                    if(!matchData){
                        $('#loadWait').hide();
                        $errorContainer.empty();
                        $errorContainer.append("The listed ingredient is not found");
                    }
                    if(matchData==ingredCountz){
                        form.unbind('submit').submit();
                    }
                });
            }
        });
    });

    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});

    $errorsDesc="";
    $errorsDay="";
    $errorsMealType="";
    $errorsMainIngredient="";

    $('form#createMealForm').validate({
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });
    console.log($('#description').val());
    console.log($('#day').val());
    console.log($('#meal_type').val());
    console.log($('#main_ingredient').val());

    $('#description').on('blur',function (){
        if($('#description').val()==""){
            $('#errorDescription').empty();
            $errorsDesc="<span style='font-size:12px;color:#ff0000;'>Please add in a description!</span>";
            $('#errorDescription').append($errorsDesc);
        }else{
            $('#errorDescription').empty();
        }
    });

    $('#main_ingredient').on('blur',function (){
        if($('#main_ingredient').val()==""){
            $('#errorMainIngredient').empty();
            $errorsMainIngredient="<span style='font-size:12px;color:#ff0000;'>Please choose a main ingredient!</span>";
            $('#errorMainIngredient').append($errorsMainIngredient);
        }else{
            $('#errorMainIngredient').empty();
        }
    });

    $('#description').on('change',function () {
        $('#errorDescription').empty();
    });


    $('#main_ingredient').on('change',function () {
        $('#errorMainIngredient').empty();
    });


    var counter = 0;
    $('#ingredientContainer').on("click","#ingredAdd",function () {
        counter+=1;
        $('#ingredError').empty();

    });
    $('#ingredientContainer').on("click",".removeField",function () {
        counter-=1;
        $('#ingredError').empty();

    });
    $errorCounter="";
    $(document).on('change','#day, #meal_type', function () {
        dayType=$('#day').val()+$('#meal_type').val();
        $('.mealTd').each(function () {
            if($(this).text().trim()!="" && $(this).attr('id')==dayType){
                $('#tdTaken').empty();
                $errorTaken="<span style='font-size:20px;color:#ff0000;'>Meal is already taken!</span>";
                $('#tdTaken').append($errorTaken);
            }else if($(this).text().trim()=="" && $(this).attr('id')==dayType){
                $('#tdTaken').empty();
            }
        });
    });
    $('form#createMealForm').submit(function (event) {
        $('#ingredError').empty();
        $('#formError').empty();

        $('.mealTd').each(function () {
            if($(this).text().trim()!="" && $(this).attr('id')==dayType){
                event.preventDefault();
            }
        });


        if(counter<1){
            event.preventDefault();
            $('#ingredError').empty();
            $errorCounter="<span style='font-size:12px;color:#ff0000;'>Please add at least one ingredient!</span>";
            $('#ingredError').append($errorCounter);
        }
        if($('#description').val()==""){
            event.preventDefault();
            $('#errorDescription').empty();
            $('#formError').empty();
            $errorsDesc="<span style='font-size:12px;color:#ff0000;'>Please add in a description!</span>";
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#errorDescription').append($errorsDesc);
            $('#formError').append($errorForm);
        }else{
            $('#errorDescription').empty();
            $('#formError').empty();
        }
        if($('#day').val()==""){
            event.preventDefault();
            $('#errorDay').empty();
            $('#formError').empty();
            $errorsDay="<span style='font-size:12px;color:#ff0000;'>Please choose a day!</span>";
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#errorDay').append($errorsDay);
            $('#formError').append($errorForm);
        }else{
            $('#errorDay').empty();
            $('#formError').empty();
        }
        if($('#meal_type').val()==""){
            event.preventDefault();
            $('#errorMealType').empty();
            $('#formError').empty();
            $errorsMealType="<span style='font-size:12px;color:#ff0000;'>Please choose a meal type!</span>";
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#errorMealType').append($errorsMealType);
            $('#formError').append($errorForm);
        }else{
            $('#errorMealType').empty();
            $('#formError').empty();
        }
        if($('#main_ingredient').val()==""){
            event.preventDefault();
            $('#errorMainIngredient').empty();
            $('#formError').empty();
            $errorsMainIngredient="<span style='font-size:12px;color:#ff0000;'>Please choose a main ingredient!</span>";
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#errorMainIngredient').append($errorsMainIngredient);
            $('#formError').append($errorForm);
        }else{
            $('#errorMainIngredient').empty();
            $('#formError').empty();
        }
        if(!$('form#createMealForm').valid()){
            $('#formError').empty();
            $errorForm="<span style='font-size:12px;color:#ff0000;'>Please fill out the form completely!</span>";
            $('#formError').append($errorForm);
        }
    });



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
                    required: "Please enter a description!"
                },
                main_ingredient: {
                    required: "Please enter a main ingredient!"
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
        console.log($(this).attr('id'));
        $(this).rules('add', {
            required: true,
            messages: "Please pick an ingredient type."
        });
    });
    $('input.ingredAuto').each(function () {
        console.log($(this).attr('id'));
        $(this).rules('add', {
            required: true,
            messages: "Please pick an ingredient."
        });
    });
    $('input.gramsAuto').each(function () {
        console.log($(this).attr('id'));
        $(this).rules('add', {
            required: true,
            messages: "Please specify number of grams."
        });
    });
});

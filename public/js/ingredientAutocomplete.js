$(document).ready(function () {
    $.ajax({
        url:'/chef/getIngredJson',
        success: function(response){
            $ingredsData=response;
            var count=0;
            $('#ingredientContainer').on("click","#ingredAdd",function () {
                count++;
                // $('#ingredientContainer').prepend('<div class="ingredients"><div class="ingredLabel"><label for="ingredients[]">Ingredients</label></div>'+'<div class="ingredSelectAdd input-field" ><input type="text" id="ingredient'+count+'" name="ingredients[]" class="autocomplete inputBehind"></div>'+
                //     '<div class="ingredGramsAdd">'+'<div class="gramLabel"><label for="grams[]">Grams</label></div>'+'<input type="number" name="grams[]" id="grams'+(count)+'" class="inputBehind"></div>'+
                // '<a href="#" class="removeField">X</a></div>');
                $('#ingredientContainer').prepend(
                    '<div id="ingredientSelection'+count+'">' +
                        '<div>' +
                            '<label for="ingredient_select[]">Ingredients</label>' +
                        '</div>' +
                        '<div id="ingredSelectContent'+count+'">' +
                            '<select id="ingredSelectOption'+count+'" name="ingredient_select[]">' +
                                '<option disabled selected>Choose Main Ingredient</option>' +
                                '<option value="Chicken">Chicken</option>' +
                                '<option value="Beef">Beef</option>' +
                                '<option value="Pork">Pork</option>' +
                                '<option value="Vegetables">Vegetables</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>');
                $('select').material_select();
                var appendCount=0;
                $('#ingredSelectContent'+count).on('change',function (){
                    appendCount+=1;
                    if(appendCount>0){
                        $('#ingredientSelection'+count).append(
                            '<div class="ingredients">' +
                            '<div class="ingredLabel">' +
                            '<label for="ingredients[]">' +
                            'Ingredients' +
                            '</label>' +
                            '</div>' +
                            '<div class="ingredSelectAdd input-field" >' +
                            '<input type="text" id="ingredient'+count+'" name="ingredients[]" class="autocomplete inputBehind">' +
                            '</div>'+
                            '<div class="ingredGramsAdd">' +
                            '<div class="gramLabel">' +
                            '<label for="grams[]">' +
                            'Grams' +
                            '</label>' +
                            '</div>' +
                            '<input type="number" name="grams[]" id="grams'+(count)+'" class="inputBehind">' +
                            '</div>'+
                            '<a href="#" class="removeField">X</a>' +
                            '</div>');

                    }else{

                    }

                });

                $(function(){
                    $('#ingredient'+count+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                })
            });
            $('#ingredientContainer').on("click",".removeField", function (e) {
                e.preventDefault();
                $(this).parent('div').remove();
                count--;
            });


            var meal_id=[];

            $('i[data-meal-id]').each(function(){
                meal_id.push($(this).attr("data-meal-id"));
            });
            for(i=0;i<meal_id.length;i++){
                (function (index) {
                    $.ajax({
                        url:'/chef/'+meal_id[index]+'/getIngredCount',
                        success:function (response) {
                            $ingredCount=response;
                            for(j=0;j<$ingredCount;j++){
                                $(function(){
                                    $('#ingredient'+meal_id[index]+j+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                                });
                            }
                        }
                    });
                })(i);
            }

        }
    });




});



$(document).ready(function () {
            var count=0;
            $('#ingredientContainer').on("click","#ingredAdd",function () {
                count++;
                // $('#ingredientContainer').prepend('<div class="ingredients"><div class="ingredLabel"><label for="ingredients[]">Ingredients</label></div>'+'<div class="ingredSelectAdd input-field" ><input type="text" id="ingredient'+count+'" name="ingredients[]" class="autocomplete inputBehind"></div>'+
                //     '<div class="ingredGramsAdd">'+'<div class="gramLabel"><label for="grams[]">Grams</label></div>'+'<input type="number" name="grams[]" id="grams'+(count)+'" class="inputBehind"></div>'+
                // '<a href="#" class="removeField">X</a></div>');
                $('#ingredientContainer').prepend(
                    '<div>' +
                    '<div id="ingredientSelection'+count+'">' +
                        '<div>' +
                            '<label for="ingredient_select[]">Ingredients</label>' +
                        '</div>' +
                        '<div id="ingredSelectContent'+count+'" class="addSelectIngred">' +
                            '<select id="ingredSelectOption'+count+'" name="ingredient_select[]" >' +
                                '<option disabled selected>Select Type of Ingredient</option>' +
                                '<option value="chicken">Chicken</option>' +
                                '<option value="beef">Beef</option>' +
                                '<option value="pork">Pork</option>' +
                                '<option value="carbohydrates(baked)">Carbohydrates(Baked)</option>' +
                                '<option value="carbohydrates(grains,pasta)">Carbohydrates(Grains, Pasta)</option>' +
                                '<option value="vegetables">Vegetables</option>' +
                            '</select>' +
                        '</div>' +
                    '</div>'+
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
                    '</div>'+
                    '<a href="#" class="removeField">X</a>' +
                    '</div>');
                $('select').material_select();
                $('.addSelectIngred').one('change','select',function (){
                    var $type=$(this).val();
                    var $ingredsAddID=$(this).parents().eq(3).find('.ingredients').find('.input-field').find('.autocomplete').attr("id");
                    $.ajax({
                        url:'/chef/'+$type+'/getIngredJson',
                        success: function(response) {
                           var $ingredsData = response;
                            // console.log($ingredsData);

                            $(function(){
                                $('#'+$ingredsAddID+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                            })
                        }
                    });

                });

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

            $('.updateIngredSelect').one('change',function (){
                var $type=$(this).val();
                var $ingredsID=$(this).parents().eq(1).find('.input-field').find('.autocomplete').attr("id");
                console.log($ingredsID);
                $.ajax({
                    url:'/chef/'+$type+'/getIngredJson',
                    success: function(response) {
                        var $ingredsData = response;

                        $(function(){
                            $('#'+$ingredsID+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                        })
                        console.log(JSON.parse($ingredsData));
                    }
                });
            });

            // for(i=0;i<meal_id.length;i++){
            //     (function (index) {
            //         $.ajax({
            //             url:'/chef/'+meal_id[index]+'/getIngredCount',
            //             success:function (response) {
            //                 $ingredCount=response;
            //                 for(j=0;j<$ingredCount;j++){
            //                     $(function(){
            //                         $('#ingredient'+meal_id[index]+j+'.autocomplete').autocomplete(JSON.parse($ingredsData));
            //                     });
            //                 }
            //             }
            //         });
            //     })(i);
            // }
});



$(document).ready(function () {
            var count=0;
            $('#ingredientContainer').on("click","#ingredAdd",function () {
                count++;

                $('#ingredient'+count).rules('add', {
                        required: true,
                        messages: "Please pick an ingredient."
                });

                $('#grams'+count).rules('add', {
                        required: true,
                        messages: "Please specify number of grams."
                });


                $('#ingredientContainer').prepend(
                    '<div class="ingredAddContainer">' +
                        '<div id="ingredientSelection'+count+'" class="ingredChefSelect">' +
                            '<div>' +
                                '<label for="ingredient_select[]">Type of Ingredient</label>' +
                            '</div>' +
                            '<div id="ingredSelectContent'+count+'" class="addSelectIngred">' +
                                '<select id="ingredSelectOption'+count+'" class="ingredChefAdd" data-error=".error-select'+count+'" name="ingredient_select['+count+']">' +
                                    '<option value="" selected>Select Type of Ingredient</option>' +
                                    '<option value="chicken">Chicken</option>' +
                                    '<option value="beef">Beef</option>' +
                                    '<option value="pork">Pork</option>' +
                                    '<option value="fish">Fish</option>' +
                                    '<option value="carbohydrates(baked)">Carbohydrates(Baked)</option>' +
                                    '<option value="carbohydrates(grains,pasta)">Carbohydrates(Grains, Pasta)</option>' +
                                    '<option value="dairy,eggs">Dairy, Eggs</option>' +
                                    '<option value="beans,peanuts">Beans, Peanuts</option>' +
                                    '<option value="fat,oils">Dressings, Oil</option>' +
                                    '<option value="soups,sauces,gravy">Soups, Sauces, Gravy</option>' +
                                    '<option value="fruits">Fruits, Fruit Juices</option>' +
                                    '<option value="vegetables">Vegetables</option>' +
                                '</select>' +
                            '</div>' +
                            '<div class="error-select'+count+' err"></div>' +
                        '</div>'+
                        '<div class="ingredients">' +
                            '<div class="ingredLabel">' +
                                '<label for="ingredients[]">' +
                                    'Ingredient' +
                                '</label>' +
                            '</div>' +
                            '<div id="ingredInput'+count+'" class="ingredSelectAdd input-field" >' +
                                    '<input type="text" id="ingredient'+count+'" name="ingredients['+count+']" data-error=".error-ingredient'+count+'" class="autoCreate autocomplete">' +
                            '</div>'+
                            '<div class="error-ingredient'+count+' err"></div>' +
                                '<div class="ingredGramsAdd">' +
                                    '<div class="gramLabel">' +
                                        '<label for="grams[]">' +
                                            'Grams' +
                                        '</label>' +
                                    '</div>' +
                                    '<input type="number" name="grams['+count+']" id="grams'+(count)+'" data-error=".error-gram'+count+'" class="createGrams inputBehind">' +
                                '</div>'+
                                '<div class="error-gram'+count+' err"></div>' +
                            '</div>'+
                            '<a href="#" class="removeField">X</a>' +
                        '</div>');
                $('#ingredSelectOption'+count).material_select();
                $('.addSelectIngred').on('change','select',function (){
                    var $type=$(this).val();
                    var $ingredsAddID=$(this).parents().eq(3).find('.ingredients').find('.input-field').find('.autocomplete').attr("id");
                    var prevAutoComplete=$(this).parents().eq(3).find('.ingredients').find('.input-field').attr('id');
                    $.ajax({
                        url:'/chef/'+$type+'/getIngredJson',
                        success: function(response) {
                            // console.log($('#'+prevAutoComplete).find('.autocomplete-content').attr('class'));
                            $('#'+prevAutoComplete).find('.autocomplete-content').remove();
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

            $('.updateIngredSelect').on('change',function (){
                var $type=$(this).val();
                var $ingredsID=$(this).parents().eq(1).find('.input-field').find('.autocomplete').attr("id");
                var prevUpdateComplete=$(this).parents().eq(1).find('.input-field').attr('id');
                // console.log($ingredsID);
                $.ajax({
                    url:'/chef/'+$type+'/getIngredJson',
                    success: function(response) {
                        $('#'+prevUpdateComplete).find('.autocomplete-content').remove();
                        var $ingredsData = response;

                        $(function(){
                            $('#'+$ingredsID+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                        })
                        // console.log(JSON.parse($ingredsData));
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



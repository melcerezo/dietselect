function ingredAjax(id) {
    return $.ajax({
        url:'/foodie/ingredMeal/'+id+'/get',
        dataType:'json'
    });
}

$(document).ready(function () {
    $(document).on('click','.mealLink',function(){
        var id = $(this).attr('data-id');
        var ingreds = ingredAjax(id);

        // ingreds.fail(console.log(ingreds.statusCode()));


        ingreds.done(function(response) {
            var valData = response;
            // console.log(valData);
            var groupArray = [];


            // $('#m'+id).empty();

            for(var i=0,l=valData.length;i<l;i++){
                groupArray.push(valData[i].ingredient_group);
                $('#h'+id).append(
                    '<tr>'+
                    '<td>'+valData[i].ingredient+'</td>'+
                    '<td>'+valData[i].grams+'</td>'+
                    '</tr>'
                );
            }

            var meatType=$('#m'+id).find('div.meatSection');
            var produceType=$('#m'+id).find('div.produceSection');
            var dairyType=$('#m'+id).find('div.dairySection');
            // console.log(meatType);
            // meatType.empty();
            // produceType.empty();
            // dairyType.empty();


            if($.inArray("~0500~",groupArray)!=-1 && meatType.has('div').length==0){
                meatType.append('<div>' +
                    '<div><span style="font-size: 20px;">Meat</span></div>' +
                    '<input type="radio" name="meat" value="beef" class="filled-in" id="beef'+id+'" data-error=""/>' +
                    '<label for="beef'+id+'">Switch to Beef</label><br/>' +
                    '<input type="radio" name="meat" value="pork" class="filled-in" id="pork'+id+'" data-error=""/>' +
                    '<label for="pork'+id+'">Switch to Pork</label><br/>' +
                    '<input type="radio" name="meat" value="seafood" class="filled-in" id="seafood'+id+'" data-error=""/>' +
                    '<label for="seafood'+id+'">Switch to Seafood</label><br/>' +
                    '<input type="radio" name="meat" value="vegetarian" class="filled-in" id="vege'+id+'" data-error=""/>' +
                    '<label for="vege'+id+'">Vegetarian</label><br/>' +
                    '</div>');
            }else if($.inArray("~1000~",groupArray)!=-1 && meatType.has('div').length==0){
                meatType.append('<div>' +
                    '<div><span style="font-size: 20px;">Meat</span></div>' +
                    '<input type="radio" name="meat" value="chicken" class="filled-in" id="chicken'+id+'" data-error=""/>' +
                    '<label for="chicken'+id+'">Switch to Chicken</label><br/>' +
                    '<input type="radio" name="meat" value="beef" class="filled-in" id="beef'+id+'" data-error=""/>' +
                    '<label for="beef'+id+'">Switch to Beef</label><br/>' +
                    '<input type="radio" name="meat" value="seafood" class="filled-in" id="seafood'+id+'" data-error=""/>' +
                    '<label for="seafood'+id+'">Switch to Seafood</label><br/>' +
                    '<input type="radio" name="meat" value="vegetarian" class="filled-in" id="vege'+id+'" data-error=""/>' +
                    '<label for="vege'+id+'">Vegetarian</label><br/>' +
                    '</div>');
            }else if($.inArray("~1300~",groupArray)!=-1 && meatType.has('div').length==0){
                meatType.append('<div>' +
                    '<div><span style="font-size: 20px;">Meat</span></div>' +
                    '<input type="radio" name="meat" value="chicken" class="filled-in" id="chicken'+id+'" data-error=""/>' +
                    '<label for="chicken'+id+'">Switch to Chicken</label><br/>' +
                    '<input type="radio" name="meat" value="pork" class="filled-in" id="pork'+id+'" data-error=""/>' +
                    '<label for="pork'+id+'">Switch to Pork</label><br/>' +
                    '<input type="radio" name="meat" value="seafood" class="filled-in" id="seafood'+id+'" data-error=""/>' +
                    '<label for="seafood'+id+'">Switch to Seafood</label><br/>' +
                    '<input type="radio" name="meat" value="vegetarian" class="filled-in" id="vege'+id+'" data-error=""/>' +
                    '<label for="vege'+id+'">Vegetarian</label><br/>' +
                    '</div>');
            }else if($.inArray("~1500~",groupArray)!=-1 && meatType.has('div').length==0){
                meatType.append('<div>' +
                    '<div><span style="font-size: 20px;">Meat</span></div>' +
                    '<input type="radio" name="meat" value="chicken" class="filled-in" id="chicken'+id+'" data-error=""/>' +
                    '<label for="chicken'+id+'">Switch to Chicken</label><br/>' +
                    '<input type="radio" name="meat" value="beef" class="filled-in" id="beef'+id+'" data-error=""/>' +
                    '<label for="beef'+id+'">Switch to Beef</label><br/>' +
                    '<input type="radio" name="meat" value="pork" class="filled-in" id="pork'+id+'" data-error=""/>' +
                    '<label for="pork'+id+'">Switch to Pork</label><br/>' +
                    '<input type="radio" name="meat" value="vegetarian" class="filled-in" id="vege'+id+'" data-error=""/>' +
                    '<label for="vege'+id+'">Vegetarian</label><br/>' +
                    '</div>');
            }

            for(var j=0,m=valData.length;j<m;j++){
               if(valData[j].ingredient_group=='~0100~'&&valData[j].ingredient.indexOf("Egg")>=0&& !dairyType.find('#egg'+id).length){
                   dairyType.append('<div>' +
                       '<div id="egg'+id+'"><span style="font-size: 20px;">Eggs</span></div>' +
                       '<input type="checkbox" name="eggs" value="eggs" class="filled-in" id="eggs'+id+'" data-error=""/>' +
                       '<label for="eggs'+id+'">No Eggs</label><br/>' +
                       '</div>');
                   // console.log(valData[j].ingredient.indexOf("Egg"));
               }else if((valData[j].ingredient_group=='~0100~'
                   && valData[j].ingredient.indexOf("Egg")<0)
                   || valData[j].ingredient.indexOf("milk")>=0
                   || valData[j].ingredient.indexOf("Milk")>=0
                   || valData[j].ingredient.indexOf("MILK")>=0
                   && !dairyType.find('#dairy'+id).length){
                   dairyType.append('<div>' +
                       '<div id="dairy'+id+'"><span style="font-size: 20px;">Dairy</span></div>' +
                       '<input type="checkbox" name="dairy" value="dairy" class="filled-in" id="dairy'+id+'" data-error=""/>' +
                       '<label for="dairy'+id+'">No Dairy</label><br/>' +
                       '</div>');
                   // console.log(valData[j].ingredient.indexOf("Egg"));
               }

               if(valData[j].ingredient.indexOf("Peanut")>=0 || valData[j].ingredient.indexOf("peanut")>=0
                   || valData[j].ingredient_group=='~1200~' && !produceType.find('#nut'+id).length){
                   produceType.append('<div>' +
                       '<div id="nut'+id+'"><span style="font-size: 20px;">Nuts</span></div>' +
                       '<input type="checkbox" name="nut" value="nut" class="filled-in" id="nut'+id+'" data-error=""/>' +
                       '<label for="dairy'+id+'">No Nut/Nut Products</label><br/>' +
                       '</div>');
               }
               console.log(valData[j].ingredient.indexOf("Peanut")>=0 || valData[j].ingredient.indexOf("peanut")>=0
                   || valData[j].ingredient_group=='~1200~' && !produceType.find('#nut'+id).length);

            }




            // if($.inArray("~0100~",groupArray)!=-1 && dairyType.has('div').length==0){
            //     meatType.append('<div>' +
            //         '<div><span style="font-size: 20px;">Dairy</span></div>' +
            //         '<input type="checkbox" name="eggs" value="eggs" class="filled-in" id="eggs'+id+'" data-error=""/>' +
            //         '<label for="eggs'+id+'">No Eggs</label><br/>' +
            //         '<input type="checkbox" name="cheese" value="cheese" class="filled-in" id="dairy'+id+'" data-error=""/>' +
            //         '<label for="dairy'+id+'">No Dairy</label><br/>' +
            //         '</div>');
            // }

        });


        // ingreds.done(function(response) {
        //     var valData = response;
        //     // console.log(valData);
        //     $('#m'+id).empty();
        //     for(var i=0,l=valData.length;i<l;i++){
        //         var cust = "";
        //         if(valData[i].is_customized=='0'){
        //             cust = "No";
        //         }else if(valData[i].is_customized=='1'){
        //             cust = "Yes";
        //         }
        //         $('#m'+id).append(
        //             '<tr>'+
        //             '<td>'+valData[i].ingredient+'</td>'+
        //             '<td>'+valData[i].grams+'</td>'+
        //             '</tr>'
        //         );
        //     }
        // });
    });
});
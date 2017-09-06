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
            }

            var meatType=$('#m'+id).find('div.meatSection');
            var produceType=$('#m'+id).find('div.productSection');
            var dairyType=$('#m'+id).find('div.dairySection');
            // console.log(meatType);
            // meatType.empty();
            // produceType.empty();
            // dairyType.empty();


            if($.inArray("~0500~",groupArray)!=-1 && meatType.has('div').length==0){
                meatType.append('<div>' +
                    '<input type="radio" name="foodPref" value="beef" class="filled-in" id="beef'+id+'" data-error=""/>' +
                    '<label for="beef'+id+'">Switch to Beef</label><br/>' +
                    '<input type="radio" name="foodPref" value="pork" class="filled-in" id="pork'+id+'" data-error=""/>' +
                    '<label for="pork'+id+'">Switch to Pork</label><br/>' +
                    '<input type="radio" name="foodPref" value="seafood" class="filled-in" id="seafood'+id+'" data-error=""/>' +
                    '<label for="seafood'+id+'">Switch to Seafood</label><br/>' +
                    '<input type="radio" name="foodPref" value="vegetarian" class="filled-in" id="vege'+id+'" data-error=""/>' +
                    '<label for="vege'+id+'">Vegetarian</label><br/>' +
                    '</div>');
            }else if($.inArray("~1000~",groupArray)!=-1 && meatType.has('div').length==0){
                meatType.append('<div>' +
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
            // $('#m'+id).append(
            //     '<tr>'+
            //     '<td>'+valData[i].ingredient+'</td>'+
            //     '<td>'+valData[i].grams+'</td>'+
            //     '</tr>'
            // );
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
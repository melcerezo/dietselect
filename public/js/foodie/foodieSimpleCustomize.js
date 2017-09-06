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
            console.log(meatType);

            if($.inArray("~0500~",groupArray)!=-1){

            }else if($.inArray("~1000~",groupArray)!=-1){

            }else if($.inArray("~1300~",groupArray)!=-1){

            }else if($.inArray("~1500~",groupArray)!=-1){

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
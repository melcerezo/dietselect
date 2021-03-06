function ingredAjax(id,cust) {
    return $.ajax({
        url:'/foodie/ingred/'+id+'/get/'+cust,
        dataType:'json'
    });
}

$(document).ready(function () {
    $(document).on('click','.mealLink',function(){
        var id = $(this).attr('data-id');
        var cust = $(this).attr('data-cust');
        var ingreds = ingredAjax(id,cust);

        // ingreds.fail(console.log(ingreds.statusCode()));

        ingreds.done(function(response) {
            var valData = response;
            // console.log(valData);
            $('#m'+id).empty();

            for(var i=0,l=valData.length;i<l;i++){
                var cust = "";
                if(valData[i].is_customized=='0'){
                    cust = "No";
                }else if(valData[i].is_customized=='1'){
                    cust = "Yes";
                }
                $('#m'+id).append(
                    '<tr>'+
                    '<td>'+valData[i].ingredient+'</td>'+
                    '<td>'+valData[i].grams+'</td>'+
                    '<td>'+cust+'</td>'+
                    '</tr>'
                );
            }
        });
    });
});
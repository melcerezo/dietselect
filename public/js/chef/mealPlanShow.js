function ingredAjax(id) {
    return $.ajax({
        url:'/chef/ingred/'+id+'/get',
        dataType:'json'
    });
}

$(document).ready(function () {
    $(document).on('click','.mealLink',function(){
        var id = $(this).attr('data-id');
        var ingreds = ingredAjax(id);

        ingreds.fail(console.log(ingreds.statusCode()));

        ingreds.done(function(response) {
            var valData = response;
            console.log(valData);
            // for(var i=0,l=valData.length;i<l;i++){
            //     $('#m'+id).append(
            //         '<tr>'+
            //         '<td>'+valData[i].ingredient+'</td>'+
            //         '<td>'+valData[i].grams+'</td>'+
            //         '<td>'+valData[i].is_customized+'</td>'+
            //         '</tr>'
            //     );
            // }


        });

    });
});
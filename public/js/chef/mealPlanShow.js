function ingredAjax($id) {
    return $.ajax({
        url:'/chef/ingred/get/'+ $id,
        dataType:'json'
    });
}

$(document).ready(function () {
    $(document).on('click','.mealLink',function(){
        var id = $(this).attr('data-id');
        console.log(id);
        var ingreds = ingredAjax(id);

        ingreds.done(function (response) {
            var valData = response;
            for(var i=0,l=data.length;i<l;i++){
                $('#m'+id).append(
                    '<tr>'+
                    '<td>'+valData[i].ingredient+'</td>'+
                    '<td>'+valData[i].grams+'</td>'+
                    '<td>'+valData[i].is_customized+'</td>'+
                    '</tr>'
                );
            }


        });

    });
});
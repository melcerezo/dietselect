function ingredAjax(id,type) {
    return $.ajax({
        url:'/chef/ingred/'+id+'/get/'+type,
        dataType:'json'
    });
}

$(document).ready(function () {
    $('#deliverButton').click(function () {
        $('#loadWait').show();
    });
    $(document).on('click','.mealLink',function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-cust');
        var ingreds = ingredAjax(id,type);

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

    $('input[type=radio][name=cancelReason]').change(function () {
        if($(this).val()==4){
            $('#otherReasonContainer').show();
        }else{
            $('#otherReasonContainer').hide();
        }
    });

    $('#cancelOrderItemButton').click(function () {
        $('#loadWait').show();
    });
});
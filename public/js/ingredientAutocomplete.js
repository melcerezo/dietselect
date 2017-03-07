$(document).ready(function () {

    var $ingredsData='';



        $.ajax({
            url:'/chef/getIngredJson',
            success: function(response){
                $ingredsData=response;
                console.log($ingredsData);

                var count=0;
                $('#ingredAdd').click(function () {
                    count+=1;
                    $(function(){
                        $('#ingredient'+count+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                    })
                });

            }
        });




});

function ingredSelect(num){

    return $('#ingredSel'+num+'.autocomplete').autocomplete(JSON.parse(response));

}


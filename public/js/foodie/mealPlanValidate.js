$(document).ready(function () {

    // $(document).on('click','.modal-trigger',function (e) {
    //     e.preventDefault();
    //     $('form#'+subId).submit();
    //     var id = $(this).attr('id');
    //     inform(id);
    //     // var subId=$(this).attr('data-form-id');
    // });

    // for($i=0;){
    //
    // }

    $("select.updateIngredSelect").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});

    $('form.editMeal').submit(function (e) {
        e.preventDefault();
        var form=$(this);
        var ingredSelect=form.find("#ingredSelect").children();
        var ingredFind=ingredSelect.children('.ingredSelectAdd');
        var ingredCountz=ingredFind.length;
        console.log(ingredCountz);
        var matchData=0;
        $(ingredFind).each(function () {
            var ingredIn=$(this).find('input.autocomplete');
            var $thisVal=ingredIn.val();
            var $error=ingredIn.attr('data-error');
            var $errorContainer=ingredIn.parents().eq(1).find($error);
            if($thisVal!=""){
                var $thisSelect=ingredIn.parents().eq(1).find('select.updateIngredSelect');
                var $valType=$("option:selected",$thisSelect).val().toLowerCase();
                $.ajax({
                    url: '/foodie/' + $valType + '/validateIngredJson',
                    success: function (response) {
                        var valData=JSON.parse(response);
                        for(var i = 0,l=valData.length;i<l;i++){
                            var ingred= valData[i].name;
                            if($thisVal==ingred){
                                matchData+=1;
                            }
                        }
                        pushToMatchArray(matchData);

                        if(!matchData){
                            $errorContainer.append("The listed ingredient is not found");
                        }



                    }
                });
            }else{
                e.preventDefault();
            }
            function pushToMatchArray(match){
                console.log(match);
                return match;
            }
            // console.log(pushToMatchArray());
            function submitForm() {

            }
            // console.log(pushToMatchArray());
        });
    });



    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
    $('form.editMeal').each(function () {
        console.log($(this).attr('id'));
        $(this).validate({
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            }

        });
    });
});

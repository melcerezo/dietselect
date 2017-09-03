// $(window).load(function () {
//     $("#loadWait").delay(700).fadeOut("slow");
// });
$(document).ready(function () {

    // $(document).on('click','.modal-trigger',function (e) {
    //     e.preventDefault();
    //     $('form#'+subId).submit();
    //     var id = $(this).attr('id');
    //     inform(id);
    //     // var subId=$(this).attr('data-form-id');
    // });

    function ingredAjax($valType){
        return $.ajax({
            url: '/foodie/' + $valType + '/validateIngredJson',
            dataType:'json'
        });
    }

    var orig =[];

    $.fn.getType = function () {
        return this[0].tagName == "INPUT" ? $(this[0]).attr("type").toLowerCase() : this[0].tagName.toLowerCase();
    };

    $('#orderFrm').submit(function () {
        $('#loadWait').show();
    });

    $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});

    $("select.updateIngredSelect").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});




    $('form.editMeal').each(function () {
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

    // console.log(orig);




    $('form.editMeal').bind('change', function () {
        var button = $(this).find('button.updateB');
        var disable = true;
        var inputs =$(this).find('input');
        inputs.each(function () {
            var type = $(this).getType();
            if($(this).hasClass('select-dropdown')){
                type = 'select';
            }
            var id = $(this).attr('id');
            if (type == 'text' || type == 'number') {
                disable = ($(this).attr('data-orig') == $(this).val());
            } else if (type == 'radio') {
                disable = ($(this).attr('data-orig').checked == $(this).is(':checked'));
            } else if(type == 'select'){
                var selz = $(this).siblings('select.upSel');
                disable = (selz.attr('data-orig') == selz.val());
            }
            if (!disable) {
                return false; // break out of loop
            }
        });

        button.prop('disabled', disable);

    });

    $('button.updateB').click(function () {
        var form=$(this).closest("form");
        console.log(form);

        var ingredSelect=form.find("#ingredSelect").children();
        var ingredFind=ingredSelect.children('.ingredSelectAdd');
        var ingredCountz=ingredFind.length;
        console.log(ingredCountz);
        var matchData=0;
        $('#loadWait').show();
        $(ingredFind).each(function () {
            var ingredIn=$(this).find('input.autocomplete');
            var $thisVal=ingredIn.val();
            var $error=ingredIn.attr('data-error');
            var $errorContainer=ingredIn.parents().eq(1).find($error);
            if($thisVal!=""){
                var $thisSelect=ingredIn.parents().eq(1).find('select.updateIngredSelect');
                var $valType=$("option:selected",$thisSelect).val().toLowerCase();
                if($valType=="fruits/fruit juices"){
                    $valType='fruits';
                }else if($valType=='carbohydrates(grains, pasta)'){
                    $valType='carbohydrates(grains,pasta)';
                }else if($valType=='fish/shellfish'){
                    $valType='fish';
                }else if($valType=='dairy,egg'){
                    $valType='dairy,eggs';
                }else if($valType=='soups,sauces,gravies'){
                    $valType='soups,sauces,gravy';
                }
                var $ingredientAuto=ingredAjax($valType);
                $ingredientAuto.done(function(response){
                    // console.log('This is in ajax');
                    var valData=response;
                    for(var i = 0,l=valData.length;i<l;i++){
                        var ingred= valData[i].name;
                        if($thisVal==ingred){
                            matchData+=1;
                            $errorContainer.empty();
                        }else{
                            console.log('no match');
                        }
                    }
                    console.log(!matchData);
                    if(!matchData){
                        $('#loadWait').hide();
                        $errorContainer.empty();
                        $errorContainer.append("The listed ingredient is not found");
                    }
                    if(matchData==ingredCountz){
                        form.unbind('submit').submit();
                    }
                });
            }
        });
    });

    // $('form.editMeal').submit(function (e) {
    //     e.preventDefault();
    // });





});

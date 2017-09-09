$(document).ready(function () {
    $('div.buyCard').hover(function () {
        if($(this).find('.card-content').find('.buyBtn').css('visibility')=='hidden'){
            $(this).find('.card-content').find('.buyBtn').css('visibility','visible');
        }else{
            $(this).find('.card-content').find('.buyBtn').css('visibility','hidden');
        }
    });


//    chefs container
    $('.chefName').click(function () {
        var name=$(this).attr('data-chef');
        console.log('div#'+name+'Container');
        $('div#'+name+'Container').show();
    });


});
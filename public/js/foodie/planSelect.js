$(document).ready(function () {
    $('div.buyCard').hover(function () {
        if($(this).find('.card-content').find('.buyBtn').css('visibility')=='hidden'){
            $(this).find('.card-content').find('.buyBtn').css('visibility','visible');
        }else{
            $(this).find('.card-content').find('.buyBtn').css('visibility','hidden');
        }
    });

    $('.simpleLink').hover(function () {
        if($(this).find('.deleteSimpleLink').css('visibility')=='hidden'){
            $(this).find('.deleteSimpleLink').css('visibility','visible');
        }else{
            $(this).find('.deleteSimpleLink').css('visibility','hidden');
        }
    });

//    all container
    $('.allName').click(function () {
        $('.chefContainer').hide();
        $('.categoryContainer').hide();
        $('#allContainer').show();
    });

//    chefs container
    $('.chefName').click(function () {
        var name=$(this).attr('data-chef');
        $('#allContainer').hide();
        $('.chefContainer').hide();
        $('.categoryContainer').hide();
        $('#'+name+'Container').show();
    });

//    plans container
    $('.category').click(function () {
        var name=$(this).attr('data-categ');
        $('#allContainer').hide();
        $('.chefContainer').hide();
        $('.categoryContainer').hide();
        if(name=="weightCateg"){
            $('#lossContainer').show();
        }else if(name=="protCateg"){
            $('#protContainer').show();
        }else if(name=="vegeCateg"){
            $('#vegeContainer').show();
        }
    });

});
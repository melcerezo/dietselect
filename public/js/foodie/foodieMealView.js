$(document).ready(function () {
    $('.slider').slider({
        height: 350
    });

    $('.slider').on('mouseover',function () {
        $('.slider').slider('pause');
    });

    $('.galleryItem').mouseover(function () {
        var id=$(this).attr('data-galImg');
        $('.imgGall').hide();
        $('#'+id).show();

    });
    $('.galleryItem').mouseout(function () {
        $('.imgGall').hide();
        $('#plPic').show();
    });


    // $('.carousel.carousel-slider').carousel({fullWidth: true});

    $(document).on('click','.data-trigger',function () {
        var $this=$(this);
        var mealDataID= $this.attr('data-meal-active');
        $('.plSlMlInf').hide();
        $('.plSlMlInfDef').hide();
        $(mealDataID).show();
    });
    $(document).on('click','#plSlMlOrd',function () {
        window.location.href=$orderRoute;
    });
    $(document).on('click','#plSlMlCst',function () {
        window.location.href=$customizeRoute;
    });
    $(document).on('click','#plSmpCst',function () {
        window.location.href=$simpleCustomizeRoute;
    });
    $(document).on('click','#plSlMlBck',function () {
        window.location.href=$backRoute;
    });

    $(document).on('click','.plIndPht',function () {
        var phtId = $(this).attr('data-id');
        console.log(phtId);
        $('.plIndSelCls').hide();
        $(phtId).show();
    });

    $('#orderButton').on('click',function () {
        $('#loadWait').show();
    });

});
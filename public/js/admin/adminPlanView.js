$(document).ready(function () {

    $(document).on('click','.data-trigger',function () {
        var $this=$(this);
        var mealDataID= $this.attr('data-meal-active');
        $('.plSlMlInf').hide();
        $('.plSlMlInfDef').hide();
        $(mealDataID).show();
    });

    $(document).on('click','.plIndPht',function () {
        var phtId = $(this).attr('data-id');
        console.log(phtId);
        $('.plIndSelCls').hide();
        $(phtId).show();
    })
});
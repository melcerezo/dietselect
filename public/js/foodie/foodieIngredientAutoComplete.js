$(document).ready(function () {
    function ingredAjax($type){
        return $.ajax({
            url: '/foodie/' + $type + '/getIngredJson',
            dataType: 'json'
        });
    }

    $('.ingredSelectContainer').each(function () {
        var $type = $(this).attr("data-ing-type").toLowerCase();
        var $ingredField = $(this).find('.input-field');
        var $ingredID = $ingredField.find('.autocomplete').attr('id');


        $.ajax({
            url: '/foodie/' + $type + '/getIngredJson',
            success: function (response) {
                var $jsonData=JSON.parse(response);
                $(function () {
                    $('#' + $ingredID + '.autocomplete').autocomplete($jsonData);
                });
            }
        });
    });




    $('.updateIngredSelect').on('change', function () {
        var $type = $(this).val();
        var $ingredsID = $(this).parents().eq(1).find('.input-field').find('.autocomplete').attr("id");
        var prevUpdateComplete=$(this).parents().eq(1).find('.input-field').attr('id');
        $.ajax({
            url: '/foodie/' + $type + '/getIngredJson',
            success: function (response) {
                $('#'+prevUpdateComplete).find('.autocomplete-content').remove();
                var $ingredsData = response;
                $(function () {
                    $('#' + $ingredsID + '.autocomplete').autocomplete(JSON.parse($ingredsData));
                })
                // console.log(JSON.parse($ingredsData));
            }
        });
    });
});
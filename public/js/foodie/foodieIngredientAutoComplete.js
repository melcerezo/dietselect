$(document).ready(function () {
    $('.updateIngredSelect').on('change', function () {
        var $type = $(this).val();
        var $ingredsID = $(this).parents().eq(1).find('.input-field').find('.autocomplete').attr("id");
        var prevUpdateComplete=$(this).parents().eq(1).find('.input-field').attr('id');
        console.log($type);
        $.ajax({
            url: '/foodie/' + $type + '/getIngredJson',
            success: function (response) {
                $('#'+prevUpdateComplete).find('.autocomplete-content').remove();
                var $ingredsData = response;
                $(function () {
                    $('#' + $ingredsID + '.autocomplete').autocomplete(JSON.parse($ingredsData));
                })
                console.log(JSON.parse($ingredsData));
            }
        });
    });
});
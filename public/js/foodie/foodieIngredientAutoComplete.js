$(document).ready(function () {
    $('.updateIngredSelect').one('change', function () {
        var $type = $(this).val();
        var $ingredsID = $(this).parents().eq(1).find('.input-field').find('.autocomplete').attr("id");
        console.log($type);
        $.ajax({
            url: '/foodie/' + $type + '/getIngredJson',
            success: function (response) {
                var $ingredsData = response;

                $(function () {
                    $('#' + $ingredsID + '.autocomplete').autocomplete(JSON.parse($ingredsData));
                })
                console.log(JSON.parse($ingredsData));
            }
        });
    });
});
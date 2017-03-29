$(document).ready(function(){
    $(document).on('click','.revealMessageContent',function () {
        var id = $(this).attr('id');
        console.log(id);
        RevealMessage(id);
    });

});
    // var message_id=[];
    //
    // $('i[data-message-id]').each(function(){
    //     message_id.push($(this).attr("data-message-id"));
    // });


function RevealMessage(mId){
    $("#mCon"+mId).slideToggle(function () {
        if($('#mCon'+mId).is(':hidden')){
            $.ajax({

            });
        }
    });
    console.log(mId);
}
$(document).ready(function(){

    $('#msg-'+messageId).show();
    $('#msgItem-'+messageId).addClass('msgActive');



    $(document).on('click','.revealMessageContent',function () {
        var id = $(this).attr('id');
        // console.log(id);
        RevealMessage(id);
    });



});

function RevealMessage(mId){
    $("#mCon"+mId).slideToggle();
    console.log(mId);
}
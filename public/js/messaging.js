$(document).ready(function(){

    $('#chat-'+chatId).show();
    $('#chtItem-'+chatId).addClass('msgActive');



    $(document).on('click','.revealMessageContent',function () {
        var id = $(this).attr('id');
        // console.log(id);
        RevealMessage(id);
    });

    $(document).on('click','#msgCmpsCls',function () {
        $('#crtMsg').closeModal();
    })


});

function RevealMessage(mId){
    $("#mCon"+mId).slideToggle();
    console.log(mId);
}
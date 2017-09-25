$(document).ready(function(){

    if(chatId!=null){
        $('#chat-'+chatId).show();
        $('#chtItem-'+chatId).addClass('msgActive');
    }

    $(document).on('click','.rplBtn', function(){
        var $this=$(this);
        $('#replyRecName').empty();
        $('#replyRecName').append($this.attr('data-rec-name'));
        $('#replySubject').val('RE:'+$this.attr('data-rpl-sub'));
        $('#replyRec').val($this.attr('data-rec'));
        $('#chtId').val($this.attr('data-chat-id'));
    });

    $(document).on('click','.revealMessageContent',function () {
        var id = $(this).attr('id');
        // console.log(id);
        RevealMessage(id);
    });

    $(document).on('click','#msgCmpsCls',function () {
        $('#crtMsg').closeModal();
    });
    $(document).on('click','#msgRplCls',function () {
        $('#rplMsg').closeModal();
    });


});

function RevealMessage(mId){
    $("#mCon"+mId).slideToggle();
    console.log(mId);
}
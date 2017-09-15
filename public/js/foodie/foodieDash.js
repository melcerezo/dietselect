$(document).ready(function () {
   $('.simpleLink').hover(function () {
       if($(this).find('.deleteSimpleLink').css('visibility')=='hidden'){
           $(this).find('.deleteSimpleLink').css('visibility','visible');
       }else{
           $(this).find('.deleteSimpleLink').css('visibility','hidden');
       }
   });
});
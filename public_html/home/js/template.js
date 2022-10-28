 
(function ($) {
    $(document).ready(function () {


$('.tab-nav li').click(function(){
    var a= $(this).index();
    var b= $(this).parent().parent().siblings('.tab-container');
        $(this).addClass('active').siblings().removeClass('active');
        b.children('ul').children('li').eq(a).addClass('active').siblings().removeClass('active');
})


$('.inputs').keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).next('.inputs').focus();
    }
});



$('.messages .message h4').click(function(){
    if($(this).parent().hasClass('active')){
        $(this).parent().removeClass('active');
        $(this).siblings('.txt').slideUp();
    }else{
        $(this).parent().addClass('active').siblings().removeClass('active').children('.txt').slideUp();
        $(this).siblings('.txt').slideDown();
    }
})

 

    })
})(jQuery);
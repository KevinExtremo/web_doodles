$(window).resize(function(){
    var height = window.innerHeight - ($('.navbar-custom').height() + $('.banner').height() + $('.cp-header').height() + $('footer').height()+6);   
    $('.cp-content').height(height);
    $('.cp-sidebar').height(height);
    $('.cp-main').height(height);
});
$(window).resize(); // on page load
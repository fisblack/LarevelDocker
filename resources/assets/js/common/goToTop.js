$(document).ready(function(){
  var goToTop = $(".back-to-top");

  $(window).scroll(function(){
    if ($(this).scrollTop() > 400){
      goToTop.stop().fadeIn();
    } else {
      goToTop.stop().fadeOut();
    }

  });

  goToTop.click(function(){
    $("html,body").animate({
      scrollTop : 0
    }, 1000);
  });
});

$(document).ready(function () {
  var uriControllers = "./controllers/";

  $("header .header .header-config .user h4").click(function(){
    if($(this).hasClass("active")){
      $(this).removeClass("active");
      $("header .header .header-config .user ul").fadeOut();
    }else{
      $(this).addClass("active");
      $("header .header .header-config .user ul").fadeIn();
    }
    $(".profile .profile-list").hide();
  })
});

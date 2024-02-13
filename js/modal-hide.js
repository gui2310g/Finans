$("#dropdown_menu").hide();
$(document).ready(function () {
      $("#toggle_btn").click(function () {
          $("#dropdown_menu").slideToggle("slow");
          $("#home1").animate({
              marginTop: ($("#home1").css("marginTop") === "0px") ? '160px' : '0'
          });
      });
  });
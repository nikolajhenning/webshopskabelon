  jQuery(function($){
  $(document).ready(function () {
    $( ".cat-parent > a" ).after( "<span><i class='icon-toggle fas fa-angle-down'></i></span>" );   
    $(".icon-toggle").click(function (e) {
      var showListElements = $(this).parents(".cat-parent").find(".children");
  
      if ($(showListElements).is(":visible")) {
        showListElements.hide("fast", "swing");
        $(this).css({'transform' : 'rotate('+ 0 +'deg)'});
      } 
      else {
        showListElements.show("fast", "swing");
        $(this).css({'transform' : 'rotate('+ -180 +'deg)'});
      }
    });
  });
});
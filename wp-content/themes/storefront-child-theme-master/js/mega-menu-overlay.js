jQuery(function($){
    $(document).ready(function () {
        $('.smm-active').hover(function(){
            $('#menu-background-overlay').fadeTo(200, 0.2);
        }, function(){
            $('#menu-background-overlay').fadeTo(200, 0, function(){
                $(this).hide();
            });
        });   
    });
  });
  
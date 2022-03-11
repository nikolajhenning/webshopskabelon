  jQuery(function($){
    $(document).ready(function(){
        $( ".cat-parent > a" ).after( "<span class='icon-toggle'><i class='fas fa-angle-down'></i></span>" );  
        if ($(".current-cat-parent")[0]){
            $( ".current-cat-parent").addClass( "active" );
        }            
        $(".cat-parent").click(function(){
            $(this).toggleClass("active");
        });
    });
});


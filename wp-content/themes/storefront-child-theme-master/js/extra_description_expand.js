jQuery( function( $ ) {
    var s = $(".long-term-description").html();
    var split_lenght = 150;
    
    if (s.split(' ').length > split_lenght) {
    
        //Add "non-expand" class
        $( ".long-term-description" ).addClass( "non-expand" );
      
        //Read more button
        $(".long-term-description").after( "<a class='read-button'>Læs mere</a>" );
    
        //Text split
        $(".long-term-description").html(s.split(' ').slice(0,split_lenght).join(' ') + " ... ");
      
      //On click toggle between full html and splittet html
         $( ".read-button" ).on( "click", function() {
             $(".long-term-description").toggleClass('non-expand expand');
            
        var button_text = $(".long-term-description").hasClass('expand') ? 'Læs mindre' : 'Læs mere';
        $(".read-button").text(button_text);
    
            $(".long-term-description").hasClass('non-expand') ? $(".long-term-description").html(s.split(' ').slice(0,split_lenght).join(' ') + " ... ") : $(".long-term-description").html(s);
                    
                    
    });
    }
});
jQuery( function( $ ) {
    $(document).ready(function() {

        //Get current height of the description container
        let currentHeight = $(".long-term-description").height();
        if (currentHeight > 350 ) {

            //Add "non-expand" class
            $( ".long-term-description" ).addClass( "non-expand" );

            //Add 'Read more' button
            $(".long-term-description").after( "<a class='read-button read-more'>Læs mere</a>" );

            //Set description container back to its original height
            $( ".read-button" ).on( "click", function(evt) {
                evt.preventDefault();
                $(".long-term-description").toggleClass('expand non-expand');
                var button_text = $(".long-term-description").hasClass('expand') ? 'Læs mindre' : 'Læs mere';
                $(".read-button").text(button_text);
            });
        }
    });
});


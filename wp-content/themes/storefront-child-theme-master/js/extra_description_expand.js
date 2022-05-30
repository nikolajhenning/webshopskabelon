jQuery( function( $ ) {
    $(document).ready(function() {

        //Get current height of the description container
        let currentHeight = $(".long-term-description").height();
        if (currentHeight > 100 ) {

            //Set heigth of the description container
            $(".long-term-description").css({
                "height": "100px", 
                "overflow": "hidden",
                "transition": "max-height 0.4s ease-out", 
            });

            //Add "non-expand" class
            $( ".long-term-description" ).addClass( "non-expand" );

            //Add 'Read more' button
            $(".long-term-description").after( "<a class='read-button'></a>" );
            $( ".read-button" ).addClass( "read-more" );
            $(".read-more").text("Læs mere");

            //Set description container back to its original height
            $( ".read-more" ).on( "click", function() {
                $(".long-term-description").toggleClass('expand non-expand');
                $(".read-button").toggleClass('read-more read-less');
                $(".read-less").text("Læs mindre");
                $(".read-more").text("Læs mere");
                $(".expand").css({
                    height: currentHeight,
                    "max-height": currentHeight,
                });
                $(".non-expand").css({
                    "max-height": "100px",
                });
            });
        }
    });
});


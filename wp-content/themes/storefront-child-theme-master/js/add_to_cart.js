jQuery(function($) {

        $('form.cart').on('submit', function(e) {
            e.preventDefault();

            var form   = $(this),
                mainId = form.find('.single_add_to_cart_button').val(),
                fData  = form.serializeArray();

            form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

            if ( mainId === '' ) {
                mainId = form.find('input[name="product_id"]').val();
            }

            if ( typeof wc_add_to_cart_params === 'undefined' )
                return false;

            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'custom_add_to_cart' ),
                data : {
                    'product_id': mainId,
                    'form_data' : fData,
                },
                success: function (response) {
                    $(document.body).trigger("wc_fragment_refresh");
                    $('.woocommerce-error,.woocommerce-message').remove();
                    $('input[name="quantity"]').val(1);
                    $('.header-cart-wrapper').after(response);
                    $('#cart-preview').slideDown(300).delay(2000).slideUp(300);
                    form.unblock();
                    console.log(response);                    
                },
                error: function (error) {
                    form.unblock();
                    // console.log(error);
                }
            });
        });

});
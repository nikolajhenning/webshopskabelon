<?php

/* Delivery based on categories */

/**
 * Filter shipping methods in the checkout
 */
add_filter( 'woocommerce_package_rates', 'wooelements_filter_shipping_methods', 10, 2 );
function wooelements_filter_shipping_methods( $rates, $package ) {
	// Find GLS PakkeShop shipping method
	$economy_shipping_method_key = FALSE;
	foreach ( $rates as $rate_key => $rate ) {
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "GLS - PakkeShop" ) {
			$economy_shipping_method_key = $rate_key;
        }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "GLS - Erhverv" ) {
			$economy_shipping_method_key = $rate_key;
	      }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "GLS - Privatlevering" ) {
			$economy_shipping_method_key = $rate_key;
        }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "PostNord - Privatlevering" ) {
			$economy_shipping_method_key = $rate_key;
        }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "PostNord - Erhverv" ) {
			$economy_shipping_method_key = $rate_key;
	      }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "PostNord - PakkeShop" ) {
			$economy_shipping_method_key = $rate_key;
        }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "Dao - Privatlevering" ) {
			$economy_shipping_method_key = $rate_key;
	      }
		if ( is_object( $rate ) && method_exists( $rate, 'get_label' ) && $rate->get_label() === "Dao - PakkeShop" ) {
			$economy_shipping_method_key = $rate_key;
        }
	}

	return $rates;
}

/* Insert image before label on shipping method  */
function filter_woocommerce_cart_shipping_method_full_label( $label, $method ) {
    // Remove afterwards
    //echo 'DEBUG: method id = '. $method->label;
    // Use the condition here with $method to apply the image to a specific method.    
    if ( $method->instance_id == 1 ) {
      $label = "<i class='fas fa-truck'></i>" . $label;
    }
    elseif ( $method->instance_id == 2 ) {
      $label = "<i class='fas fa-store-alt'></i>" . $label;
    }
    elseif ( $method->instance_id == 3 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/gls-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='GLS logo' />" . $label;
    }
    elseif ( $method->instance_id == 4 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/gls-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='GLS logo' />" . $label;
    }
    elseif ( $method->instance_id == 5 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/gls-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='GLS logo' />" . $label;
    }
    elseif ( $method->instance_id == 6 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/postnord-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='PostNord logo' />" . $label;
    }
    elseif ( $method->instance_id == 7 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/postnord-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='PostNord logo' />" . $label;
    }
    elseif ( $method->instance_id == 10 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/postnord-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='PostNord logo' />" . $label;
    }
    elseif ( $method->instance_id == 8 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/dao-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='DAO logo' />" . $label;
    }
    elseif ( $method->instance_id == 9 ) {
      $gls_image_url = get_stylesheet_directory_uri() . '/img/dao-logo.svg';
      $label = "<img class='shipping_logo' src='" . $gls_image_url . " ' " . "alt='DAO logo' />" . $label;
    }
    else {
      $label = "<i class='fas fa-truck'></i>" . $label;
    }
    
    return $label; 
  }
  add_filter( 'woocommerce_cart_shipping_method_full_label', 'filter_woocommerce_cart_shipping_method_full_label', 10, 2 ); 
  

/* Hide shipping based on category */
function product_category_hide_shipping_methods( $rates, $package ){

    // HERE set your product categories in the array (IDs, slugs or names)
    $categories = array( 'cykler');
    $found = false;

    // Loop through each cart item Checking for the defined product categories
    foreach( $package['contents'] as $cart_item ) {
        if ( has_term( $categories, 'product_cat', $cart_item['product_id'] ) ){
            $found = true;
            break;
        }
    }

    $rates_arr = array();
    if ( $found ) {
        foreach($rates as $rate_id => $rate) { 
            if ('local_pickup' === $rate->method_id) {
                $rates_arr[ $rate_id ] = $rate;
            }
        }
    }
    return !empty( $rates_arr ) ? $rates_arr : $rates;
}
add_filter( 'woocommerce_package_rates', 'product_category_hide_shipping_methods', 90, 2 );
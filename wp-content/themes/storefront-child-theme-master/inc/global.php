<?php

/* Logo */
add_theme_support( 'custom-logo' );



// Remove sidebar on all Woo Pages
function iconic_remove_sidebar( $is_active_sidebar, $index ) {
    if( $index !== "sidebar-1" ) {
         return $is_active_sidebar;
     }

     if( ! is_product() ) {
        return $is_active_sidebar;
    }

     return false;
 }

add_filter( 'is_active_sidebar', 'iconic_remove_sidebar', 10, 2 );


/* Admin - WooCommerce styling */
function admin_custom_css() {
    echo '<style>
      .stock-heading {
        font-size: 1.3em;
        font-weight: 600;
        color: #23282d;
      }
    </style>';
  }

  add_action('admin_head', 'admin_custom_css');


  /*Allow SVG*/
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
   }
add_filter('upload_mimes', 'cc_mime_types');

//Disable wigdet block editor
add_filter( 'use_widgets_block_editor', '__return_false' );

//Replace the home link text

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Shop'
	$defaults['home'] = 'Shop';
	return $defaults;
}

//Replace the home link URL on product archive

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
    return $shop_page_url;
}
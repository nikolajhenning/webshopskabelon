<?php

/* Add custom socialmedia field to theme customization */

function storefrontchild_socialmedia_register_theme_customizer( $wp_customize ) {
	// Create custom panel.
	$wp_customize->add_panel( 'aside_text_blocks', array(
		'priority'       => 500,
		'theme_supports' => '',
		'title'          => __( 'Aside ikoner', 'storefrontchild' ),
		'description'    => __( 'Tilføj socialmedia field til headeren.', 'storefrontchild' ),
	) );
	// Add socialmedia field text

	//Sections
	// Add section 1.
	$wp_customize->add_section( 'custom_socialmedia_field_1' , array(
		'title'    => __('Socialmedia link 1','storefrontchild'),
		'panel'    => 'aside_text_blocks',
		'priority' => 10
    ) );
    // Add section 2.
    $wp_customize->add_section( 'custom_socialmedia_field_2' , array(
		'title'    => __('Socialmedia link 2','storefrontchild'),
		'panel'    => 'aside_text_blocks',
		'priority' => 10
    ) );
    // Add section 3.
    $wp_customize->add_section( 'custom_socialmedia_field_3' , array(
		'title'    => __('Socialmedia link 3','storefrontchild'),
		'panel'    => 'aside_text_blocks',
		'priority' => 10
    ) );
    // Add section 4.
    $wp_customize->add_section( 'custom_socialmedia_field_4' , array(
		'title'    => __('Socialmedia link 4','storefrontchild'),
		'panel'    => 'aside_text_blocks',
		'priority' => 10
    ) );
    // Add section 5.
    $wp_customize->add_section( 'custom_socialmedia_field_5' , array(
		'title'    => __('Socialmedia link 5','storefrontchild'),
		'panel'    => 'aside_text_blocks',
		'priority' => 10
    ) );
	
	//Settings
	// Add setting 1
	$wp_customize->add_setting( 'header_socialmedia_link_1', array(
		 'sanitize_callback' => 'socialmedia_sanitize_text'
    ) );
    // Add setting icon 1
	$wp_customize->add_setting( 'header_socialmedia_icon_1', array(
        'sanitize_callback' => 'sanitize_text'
    ) );	
    // Add setting 2
    $wp_customize->add_setting( 'header_socialmedia_link_2', array(
        'sanitize_callback' => 'socialmedia_sanitize_text'
    ) );
    // Add setting icon 2
	$wp_customize->add_setting( 'header_socialmedia_icon_2', array(
        'sanitize_callback' => 'sanitize_text'
    ) );	
    // Add setting 3
    $wp_customize->add_setting( 'header_socialmedia_link_3', array(
        'sanitize_callback' => 'socialmedia_sanitize_text'
    ) );
    // Add setting icon 3
	$wp_customize->add_setting( 'header_socialmedia_icon_3', array(
        'sanitize_callback' => 'sanitize_text'
    ) );	
    // Add setting 4
    $wp_customize->add_setting( 'header_socialmedia_link_4', array(
        'sanitize_callback' => 'socialmedia_sanitize_text'
    ) );
    // Add setting icon 4
	$wp_customize->add_setting( 'header_socialmedia_icon_4', array(
        'sanitize_callback' => 'sanitize_text'
    ) );
    // Add setting 5
    $wp_customize->add_setting( 'header_socialmedia_link_5', array(
        'sanitize_callback' => 'socialmedia_sanitize_text'
    ) );
    // Add setting icon 5
	$wp_customize->add_setting( 'header_socialmedia_icon_5', array(
        'sanitize_callback' => 'sanitize_text'
    ) );
	
	//Controls
	// Add control 1
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_field_1',
		    array(
		        'label'    => __( 'Socialmedia link', 'storefrontchild' ),
				'description'   => __('Indtast link til det sociale medie husk "https://www." skal med i linket', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_1',
		        'settings' => 'header_socialmedia_link_1',
		        'type'     => 'text'
            )
	    )
    );
    // Add control icon 1
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_icon_1',
		    array(
                'label'    => __( 'Socialmedia ikon', 'storefrontchild' ),
                'description'   => __('Indtast det ønskede socialemedie', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_1',
		        'settings' => 'header_socialmedia_icon_1',
		        'type'     => 'text'
		    )
	    )
    );	

    // Add control 2
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_field_2',
		    array(
		        'label'    => __( 'Socialmedia link', 'storefrontchild' ),
				'description'   => __('Indtast link til det sociale medie husk "https://www." skal med i linket', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_2',
		        'settings' => 'header_socialmedia_link_2',
		        'type'     => 'text'
		    )
	    )
    );
    // Add control icon 2
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_icon_2',
		    array(
                'label'    => __( 'Socialmedia ikon', 'storefrontchild' ),
                'description'   => __('Indtast det ønskede socialemedie', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_2',
		        'settings' => 'header_socialmedia_icon_2',
		        'type'     => 'text'
		    )
	    )
    );	

    // Add control 3
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_field_3',
		    array(
		        'label'    => __( 'Socialmedia link', 'storefrontchild' ),
				'description'   => __('Indtast link til det sociale medie husk "https://www." skal med i linket', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_3',
		        'settings' => 'header_socialmedia_link_3',
		        'type'     => 'text'
		    )
	    )
    );
    // Add control icon 3
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_icon_3',
		    array(
                'label'    => __( 'Socialmedia ikon', 'storefrontchild' ),
                'description'   => __('Indtast det ønskede socialemedie', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_3',
		        'settings' => 'header_socialmedia_icon_3',
		        'type'     => 'text'
		    )
	    )
    );	
	
    // Add control 4
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_field_4',
		    array(
		        'label'    => __( 'Socialmedia link', 'storefrontchild' ),
				'description'   => __('Indtast link til det sociale medie husk "https://www." skal med i linket', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_4',
		        'settings' => 'header_socialmedia_link_4',
		        'type'     => 'text'
		    )
	    )
    );
    // Add control icon 4
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_icon_4',
		    array(
                'label'    => __( 'Socialmedia ikon', 'storefrontchild' ),
                'description'   => __('Indtast det ønskede socialemedie', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_4',
		        'settings' => 'header_socialmedia_icon_4',
		        'type'     => 'text'
		    )
	    )
    );	
	
    // Add control 5
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_field_5',
		    array(
		        'label'    => __( 'Socialmedia link', 'storefrontchild' ),
				'description'   => __('Indtast link til det sociale medie husk "https://www." skal med i linket', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_5',
		        'settings' => 'header_socialmedia_link_5',
		        'type'     => 'text'
		    )
	    )
    );
    // Add control icon 5
	$wp_customize->add_control( new WP_Customize_Control(
	    $wp_customize,
		'custom_socialmedia_icon_5',
		    array(
                'label'    => __( 'Socialmedia ikon', 'storefrontchild' ),
                'description'   => __('Indtast det ønskede socialemedie', 'storefrontchild'),
		        'section'  => 'custom_socialmedia_field_5',
		        'settings' => 'header_socialmedia_icon_5',
		        'type'     => 'text'
		    )
	    )
    );		

 	// Sanitize text
	function socialmedia_sanitize_text( $text ) {
	    return sanitize_text_field( $text );
	}
}
add_action( 'customize_register', 'storefrontchild_socialmedia_register_theme_customizer' );

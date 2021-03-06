<?php

/**
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function twentyseventeen_latest_posts_on_sidebar_register( $wp_customize ) {

    // Load customize extra controls.
    require get_stylesheet_directory().'/inc/customizer-controls.php';

    // Load customize extra sanitize.
    require get_stylesheet_directory().'/inc/customizer-sanitize.php';

    // Load customize extra callback.
    require get_stylesheet_directory().'/inc/customizer-callback.php';
    

    /**
     * New Customizer options panel.
     * Section - latest posts section
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_section
     */

    $wp_customize->add_section(
        'latest_posts_on_sidebar',
        array(
            'title'    => __( 'Latest Posts on Sidebar', 'twentyseventeen' ),
            'priority' => 100,
        )
    );


    /**
     * New Customizer checkbox settings for the panel.
     * Setting - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
     */

    $wp_customize->add_setting('twentyseventeen_show_latest_posts',
        array(
            'default' => true,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'twentyseventeen_sanitize_checkbox', //check inc/customizer-sanitize for custom sanitize function.
        )
    );

    /**
     * New Customizer checkbox control for the panel.
     * Controls - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     *
     */

    $wp_customize->add_control('twentyseventeen_show_latest_posts',
        array(
            'label' => __('Show Latest Posts on Sidebar', 'twentyseventeen'),
            'description' => esc_html__('This is a checkbox', 'twentyseventeen'),
            'section' => 'latest_posts_on_sidebar',
            'type' => 'checkbox',
            'priority' => 100,
        )
    );


    /**
     * New Customizer texts input settings for the panel.
     * Setting - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
     */

    $wp_customize->add_setting(
        'twentyseventeen_latest_posts_section_title',
        array(
            'default'           => esc_html__('Latest Posts', 'twentyseventeen'),
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            
        )
    );


    /**
     * New Customizer input texts control for the panel.
     * Controls - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     *
     */
    $wp_customize->add_control(
        'twentyseventeen_latest_posts_section_title',
        array(
            'label' => esc_html__('Section Title', 'twentyseventeen'),
            'description' => esc_html__('This is a texts input', 'twentyseventeen'),
            'section' => 'latest_posts_on_sidebar',
            'type' => 'text',
            'priority' => 100,
            'active_callback' => 'twentyseventeen_show_latest_posts_callback'
        )
    );

    /**
     * New Customizer category dropdown settings for the panel.
     * Setting - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
     */
    $wp_customize->add_setting('twentyseventeen_latest_posts_category',
        array(
            'default' => 0,
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    );



    /**
     * New Customizer custom category control for the panel.
     * Controls - latest posts section.
     * TwentySeventeen_Dropdown_Taxonomies_Control - check custom taxonomy control on inc/customizer-controls
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     *
     */
    $wp_customize->add_control(new TwentySeventeen_Dropdown_Taxonomies_Control($wp_customize, 'twentyseventeen_latest_posts_category',
        array(
            'label' => esc_html__('Category', 'twentyseventeen'),
            'description' => esc_html__('This is a category dropdown', 'twentyseventeen'),
            'section' => 'latest_posts_on_sidebar',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 100,
            'active_callback' => 'twentyseventeen_show_latest_posts_callback'

        )));



    /**
     * New Customizer radio input  settings for the panel.
     * Setting - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_setting
     */
    $wp_customize->add_setting( 'twentyseventeen_show_latest_posts_category', array(
        'default' => 'yes',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'twentyseventeen_sanitize_select',
    ) );


    /**
     * New Customizer custom category control for the panel.
     * Controls - latest posts section.
     * https://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
     *
     */
    $wp_customize->add_control( 'twentyseventeen_show_latest_posts_category', array(
        'type' => 'radio',
        'section' => 'latest_posts_on_sidebar', // Add a default or your own section
        'label' => __( 'Show Categories' ),
        'description' => __( 'This is a custom radio input.' ),
        'choices' => array(
            'yes' => __( 'Yes' ),
            'no' => __( 'No' ),
        ),
        'priority' => 100,
        'active_callback' => 'twentyseventeen_show_latest_posts_callback'
    ) );



}
//https://codex.wordpress.org/Theme_Customization_API
add_action( 'customize_register', 'twentyseventeen_latest_posts_on_sidebar_register' );
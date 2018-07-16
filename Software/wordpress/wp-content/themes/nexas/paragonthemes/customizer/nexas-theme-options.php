<?php
/**
 * Theme Option
 *
 * @since 1.0.0
 */
$wp_customize->add_panel(
    'nexas_theme_options',
    array(
        'priority'       => 100,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => esc_html__('Theme Option', 'nexas'),
    )
);


/*----------------------------------------------------------------------------------------------*/
/**
 * Color Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'nexas_primary_color_option',
    array(
        'title'    => esc_html__('Color Options', 'nexas'),
        'panel'    => 'nexas_theme_options',
        'priority' => 9,
    )
);

$wp_customize->add_setting(
    'nexas_primary_color',
    array(
        'default'           => $default['nexas_primary_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexas_primary_color', array(
    'description'  => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'nexas'),
    'section'      => 'nexas_primary_color_option',
    'priority'     => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Top Header Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'nexas_top_header_background_color',
    array(
        'default'           => $default['nexas_top_header_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nexas_top_header_background_color', array(
    'label'         => esc_html__('Top Header Background Color', 'nexas'),
    'description'   => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'nexas'),
    'section'       => 'nexas_primary_color_option',
    'priority'      => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Top Footer Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'nexas_top_footer_background_color',
    array(
        'default'           => $default['nexas_top_footer_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'nexas_top_footer_background_color', array(
    'label'       => esc_html__('Top Footer Background Color', 'nexas'),
    'description' => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'nexas'),
    'section'     => 'nexas_primary_color_option',
    'priority'    => 14,

)));

/*-----------------------------------------------------------------------------*/
/**
 * Bottom Footer Background Color
 *
 * @since 1.0.0
 */

$wp_customize->add_setting(
    'nexas_bottom_footer_background_color',
    array(
        'default'           => $default['nexas_bottom_footer_background_color'],
        'sanitize_callback' => 'sanitize_hex_color',

    )
);

$wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize, 'nexas_bottom_footer_background_color', array(
    'label'        => esc_html__('Bottom Footer Background Color', 'nexas'),
    'description'  => esc_html__('We recommend choose  different  background color but not to choose similar to font color', 'nexas'),
    'section'      => 'nexas_primary_color_option',
    'priority'     => 14,

)));


/*-------------------------------------------------------------------------------------------*/
/**
 * Hide Static page in Home page
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'nexas_front_page_option',
    array(
        'title'    => esc_html__('Front Page Options', 'nexas'),
        'panel'    => 'nexas_theme_options',
        'priority' => 3,
    )
);

/**
 *   Show/Hide Static page/Posts in Home page
 */
$wp_customize->add_setting(
    'nexas_front_page_hide_option',
    array(
        'default'           => $default['nexas_front_page_hide_option'],
        'sanitize_callback' => 'nexas_sanitize_checkbox',
    )
);

$wp_customize->add_control('nexas_front_page_hide_option',
    array(
        'label'    => esc_html__('Hide Blog Posts or Static Page on Front Page', 'nexas'),
        'section'  => 'nexas_front_page_option',
        'type'     => 'checkbox',
        'priority' => 10
    )
);


/*-------------------------------------------------------------------------------------------*/
/**
 * Breadcrumb Options
 *
 * @since 1.0.0
 */

$wp_customize->add_section(
    'nexas_breadcrumb_option',
    array(
        'title'    => esc_html__('Breadcrumb Options', 'nexas'),
        'panel'    => 'nexas_theme_options',
        'priority' => 2,
    )
);

/*-------------------------------------------------------------------------------------------*/
/**
 * Search Placeholder
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'nexas_search_option',
    array(
        'title'     => esc_html__('Search', 'nexas'),
        'panel'     => 'nexas_theme_options',
        'priority'  => 8,
    )
);

/**
 *Search Placeholder
 */
$wp_customize->add_setting(
    'nexas_post_search_placeholder_option',
    array(
        'default'           => $default['nexas_post_search_placeholder_option'],
        'sanitize_callback' => 'sanitize_text_field',

    )
);

$wp_customize->add_control('nexas_post_search_placeholder_option',
    array(
        'label'    => esc_html__('Search Placeholder', 'nexas'),
        'section'  => 'nexas_search_option',
        'type'     => 'text',
        'priority' => 10
    )
);

/*-------------------------------------------------------------------------------------------*/
/**
 * Animation Options
 *
 * @since 1.0.4
 */
$wp_customize->add_section(
    'nexas_animation_option_section',
    array(
        'title'     => esc_html__('Disable Animation', 'nexas'),
        'panel'     => 'nexas_theme_options',
        'priority'  => 8,
    )
);

/**
 *Animation Options
*/
$wp_customize->add_setting(
    'nexas_animation_option',
    array(
        'default'           => $default['nexas_animation_option'],
        'sanitize_callback' => 'nexas_sanitize_checkbox',

    )
);

$wp_customize->add_control('nexas_animation_option',
    array(
        'label'    => esc_html__('Animation Option', 'nexas'),
        'description'=> esc_html__('Checked to hide the animation on your site', 'nexas'),
        'section'  => 'nexas_animation_option_section',
        'type'     => 'checkbox',
        'priority' => 10
    )
);

/*-------------------------------------------------------------------------------------------*/
/**
 * Go To Top Options
 *
 * @since 1.0.4
 */
$wp_customize->add_section(
    'nexas_go_to_top_option',
    array(
        'title'     => esc_html__('Go To Top Option', 'nexas'),
        'panel'     => 'nexas_theme_options',
        'priority'  => 8,
    )
);

/**
 *Go To Top Options
*/
$wp_customize->add_setting(
    'nexas_footer_go_to_top',
    array(
        'default'           => $default['nexas_footer_go_to_top'],
        'sanitize_callback' => 'nexas_sanitize_checkbox',

    )
);

$wp_customize->add_control('nexas_footer_go_to_top',
    array(
        'label'    => esc_html__('Go To Top', 'nexas'),
        'section'  => 'nexas_go_to_top_option',
        'type'     => 'checkbox',
        'priority' => 10
    )
);



/*-------------------------------------------------------------------------------------------*/
/**
 * Reset Options
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'nexas_reset_option',
    array(
        'title'    => esc_html__('Color Reset Options', 'nexas'),
        'panel'    => 'nexas_theme_options',
        'priority' => 14,
    )
);

/**
 * Reset Option
 */
$wp_customize->add_setting(
    'nexas_color_reset_option',
    array(
        'default'           => $default['nexas_color_reset_option'],
        'sanitize_callback' => 'nexas_sanitize_select',
        'transport'         => 'postMessage'
    )
);
$reset_option = nexas_reset_option();
$wp_customize->add_control('nexas_color_reset_option',
    array(
        'label'             => esc_html__('Reset Options', 'nexas'),
        'description'       => sprintf( esc_html__('Caution: Reset theme settings according to the given options. Refresh the page after saving to view the effects', 'nexas')),
        'section'           => 'nexas_reset_option',
        'type'              => 'select',
        'choices'           => $reset_option,
        'priority'          => 20
    )
);
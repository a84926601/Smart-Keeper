<?php
/**
 * Reset Option
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_reset_option
 *
 */
if (!function_exists('nexas_reset_option')) :
    function nexas_reset_option()
    {
        $nexas_reset_option = array(
            'do-not-reset' 	=> esc_html__( 'Do Not Reset','nexas'),
            'reset-all' 	=> esc_html__( 'Reset All','nexas'),
        );
        return apply_filters('nexas_reset_option', $nexas_reset_option);
    }
endif;


/**
 * Breadcrumb  display option options
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_show_breadcrumb_option
 *
 */
if (!function_exists('nexas_show_breadcrumb_option')) :
    function nexas_show_breadcrumb_option()
    {
        $nexas_show_breadcrumb_option = array(
            'enable'  => esc_html__('Enable', 'nexas'),
            'disable' => esc_html__('Disable','nexas')
        );
        return apply_filters('nexas_show_breadcrumb_option', $nexas_show_breadcrumb_option);
    }
endif;


/**
 * Top Header Section Hide/Show  options
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_show_top_header_section_option
 *
 */
if (!function_exists('nexas_show_top_header_section_option')) :
    function nexas_show_top_header_section_option()
    {
        $nexas_show_top_header_section_option = array(
            'show' => esc_html__('Show', 'nexas'),
            'hide' => esc_html__('Hide', 'nexas')
        );
        return apply_filters('nexas_show_top_header_section_option', $nexas_show_top_header_section_option);
    }
endif;


/**
 * Show/Hide Feature Image  options
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_show_feature_image_option
 *
 */
if (!function_exists('nexas_show_feature_image_option')) :
    function nexas_show_feature_image_option()
    {
        $nexas_show_feature_image_option = array(
            'show' => esc_html__('Show', 'nexas'),
            'hide' => esc_html__('Hide', 'nexas')
        );
        return apply_filters('nexas_show_feature_image_option', $nexas_show_feature_image_option);
    }
endif;


/**
 * Slider  options
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_slider_option
 *
 */
if (!function_exists('nexas_slider_option')) :
    function nexas_slider_option()
    {
        $nexas_slider_option = array(
            'show' => esc_html__('Show', 'nexas'),
            'hide' => esc_html__('Hide', 'nexas')
        );
        return apply_filters('nexas_slider_option', $nexas_slider_option);
    }
endif;

/**
 * Sidebar layout options
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_sidebar_layout
 *
 */
if (!function_exists('nexas_sidebar_layout')) :
    function nexas_sidebar_layout()
    {
        $nexas_sidebar_layout = array(
            'right-sidebar'   => esc_html__('Right Sidebar', 'nexas'),
            'left-sidebar'    => esc_html__('Left Sidebar', 'nexas'),
            'no-sidebar'      => esc_html__('No Sidebar', 'nexas'),
        );
        return apply_filters('nexas_sidebar_layout', $nexas_sidebar_layout);
    }
endif;

/**
 * Blog/Archive Description Option
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return array $nexas_blog_excerpt
 *
 */
if ( !function_exists( 'nexas_blog_excerpt' ) ) :
    
    function nexas_blog_excerpt()
    
    {
        $nexas_blog_excerpt = array(
            'excerpt' => esc_html__('Excerpt', 'nexas'),
            'content' => esc_html__('Content', 'nexas'),

        );
        return apply_filters('nexas_blog_excerpt', $nexas_blog_excerpt);
    }
endif;
<?php
/**
 * Nexas default theme options.
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */

if ( !function_exists('nexas_get_default_theme_options' ) ) :

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function nexas_get_default_theme_options()
    {

        $default = array();

        // Homepage Slider Section
        $default['nexas_homepage_slider_option']               = 'hide';
        $default['nexas_slider_cat_id']                        = 0;
        $default['nexas_no_of_slider']                         = 3;
        $default['nexas_slider_get_started_txt']               = esc_html__('Get Started!', 'nexas');
        $default['nexas_slider_get_started_link']              = '#';

        // footer copyright.
        $default['nexas_copyright']                            = esc_html__('Copyright All Rights Reserved', 'nexas');

        // Home Page Top header Info.
        $default['nexas_top_header_section']                   = 'hide';
        $default['nexas_top_header_section_phone_number_icon'] = 'fa-phone';
        $default['nexas_top_header_phone_no']                  = '';
        $default['nexas_email_icon']                           = 'fa-envelope-o';
        $default['nexas_top_header_email']                     = '';
        $default['nexas_social_link_hide_option']              = 0;

        // Blog.
        $default['nexas_sidebar_layout_option']                = 'right-sidebar';
        $default['nexas_blog_title_option']                    = esc_html__('Latest Blog', 'nexas');
        $default['nexas_blog_excerpt_option']                  = 'excerpt';
        $default['nexas_description_length_option']            = 40;
        $default['nexas_exclude_cat_blog_archive_option']      = '';
        $default['nexas_read_more_text_blog_archive_option']   = esc_html__('Read More', 'nexas');

        // Details page.
        $default['nexas_show_feature_image_single_option']     = 'show';

        // Animation Option.
        $default['nexas_animation_option']     = 0;

        //Go to Top Options
        $default['nexas_footer_go_to_top']     = 0; 

        // Color Option.
        $default['nexas_primary_color']                        = '#ec5538';
        $default['nexas_top_header_background_color']          = '#ec5538';
        $default['nexas_top_footer_background_color']          = '#1A1E21';
        $default['nexas_bottom_footer_background_color']       = '#111315';
        $default['nexas_front_page_hide_option']               = 0;
        $default['nexas_post_search_placeholder_option']       = esc_html__('Search', 'nexas');
        $default['nexas_color_reset_option']                   = 'do-not-reset';
        $default['nexas_slider_option']                       = '';

        // Pass through filter.
        $default                                               = apply_filters( 'nexas_get_default_theme_options', $default );
        return $default;
    }
endif;

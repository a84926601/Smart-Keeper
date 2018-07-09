<?php
/**
 * Nexas Theme Customizer
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('nexas_customize_register')) :
    function nexas_customize_register($wp_customize)
    {
        $wp_customize->get_setting('blogname')->transport         = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
        $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

        /*default variable used in setting*/
        $default = nexas_get_default_theme_options();

        /**
         * Customizer setting
         */
        require get_template_directory() . '/paragonthemes/core/customizer-core.php';
        require get_template_directory() . '/paragonthemes/customizer/nexas-customizer-function.php';
        require get_template_directory() . '/paragonthemes/customizer/nexas-sanitize.php';
        require get_template_directory() . '/paragonthemes/customizer/customizer.php';
        require get_template_directory() . '/paragonthemes/customizer/nexas-copy-right.php';
        require get_template_directory() . '/paragonthemes/customizer/nexas-theme-options.php';
        require get_template_directory() . '/paragonthemes/customizer/nexas-header-info-section.php';
        require get_template_directory() . '/paragonthemes/customizer/nexas-layout-design-options.php';


    }
    add_action('customize_register', 'nexas_customize_register');
endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

if (!function_exists('nexas_customize_preview_js')) :
    function nexas_customize_preview_js()
    {
        wp_enqueue_script('nexas-customizer', get_template_directory_uri() . 'assets/js/customizer.js', array('customize-preview'), '1.0.1', true);
    }

    add_action('customize_preview_init', 'nexas_customize_preview_js');

endif;

/**
 * Adding color in Theme Customizer cutom section
 */

function nexas_customizer_script() {
  
    wp_enqueue_style( 'nexas-customizer-style', get_template_directory_uri() .'/paragonthemes/core/css/customizer-style.css'); 
}
add_action( 'customize_controls_enqueue_scripts', 'nexas_customizer_script' );



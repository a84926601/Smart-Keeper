<?php
/**
 * enqueue Script for admin dashboard.
 */

if (!function_exists('nexas_widgets_backend_enqueue')) :
    function nexas_widgets_backend_enqueue($hook)
    {
        
      if ('widgets.php' != $hook) {
            return;
        }

        wp_register_script('nexas-custom-widgets', get_template_directory_uri() . '/assets/js/widgets.js', array('jquery'), true);
        wp_enqueue_media();
        wp_enqueue_script('nexas-custom-widgets');

        wp_enqueue_style('nexas-pt-admin', get_template_directory_uri() . '/assets/css/pt-admin-css.css', array(), '2.0.0');  
    }

    add_action('admin_enqueue_scripts', 'nexas_widgets_backend_enqueue');
endif;


/**
 * enqueue Admins style for admin dashboard.
 */

if ( !function_exists( 'nexas_admin_css_enqueue' ) ) :
    
    function nexas_admin_css_enqueue($hook)
    
    {
        if ( 'post.php' != $hook ) {
            return;
        }
        wp_enqueue_style('nexas-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');
        wp_enqueue_style('nexas-pt-admin', get_template_directory_uri() . '/assets/css/pt-admin-css.css', array(), '2.0.0');  

        wp_register_script('nexas-page-builder-widgets', get_template_directory_uri() . '/assets/js/page-builder-widgets.js', array('jquery'), true);
        wp_enqueue_media();
        wp_enqueue_script('nexas-page-builder-widgets');

      
         }
    add_action('admin_enqueue_scripts', 'nexas_admin_css_enqueue');
endif;


if ( !function_exists( 'nexas_admin_css_enqueue_new_post')) :
    
    function nexas_admin_css_enqueue_new_post( $hook )
    
    {
        if ( 'post-new.php' != $hook ) {
            return;
        }

        wp_enqueue_style('nexas-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '2.0.0');

        wp_enqueue_style('nexas-pt-admin', get_template_directory_uri() . '/assets/css/pt-admin-css.css', array(), '2.0.0');  


        wp_register_script('nexas-page-builder-widget', get_template_directory_uri() . '/assets/js/page-builder-widgets.js', array('jquery'), true);

        wp_enqueue_media();

        wp_enqueue_script('nexas-page-builder-widget');
    }
    add_action( 'admin_enqueue_scripts', 'nexas_admin_css_enqueue_new_post' );
endif;


/**
 * Functions for get_theme_mod()
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */

if ( !function_exists( 'nexas_get_option' ) ) :

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function nexas_get_option( $key = '' )
    {
        if (empty( $key ) ) {
            return;
        }
        $nexas_default_options = nexas_get_default_theme_options();

        $default      = (isset($nexas_default_options[$key])) ? $nexas_default_options[$key] : '';

        $theme_option = get_theme_mod($key, $default);

        return $theme_option;

    }

endif;

/**
 * Sanitize Multiple Category
 * =====================================
 */

if ( !function_exists('nexas_sanitize_multiple_category') ) :

function nexas_sanitize_multiple_category( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

endif;

/**
 * remove [..] from excerpt
 * =====================================
 */
function nexas_excerpt_more( $more ) {
    if( !is_admin() ){
     return '';
    }
}
add_filter('excerpt_more', 'nexas_excerpt_more');

/**
 * Goto Top functions
 *
 * @since Nexas 1.0.0
 *
 */

if (!function_exists('nexas_go_to_top' )) :
    function nexas_go_to_top()
    {
         $nexas_to_top = nexas_get_option('nexas_footer_go_to_top');                 
         if( $nexas_to_top == 1 )
         {
            ?>
            <a id="toTop" class="go-to-top" href="#" title="<?php esc_attr_e('Go to Top', 'nexas'); ?>">
                    <i class="fa fa-angle-double-up"></i>
            </a>
        <?php
        }
    }

add_action('nexas_go_to_top_hook', 'nexas_go_to_top', 20 );
endif;

/**
 * Load Metabox file
 * =====================================
 *
 * /**
 * Metabox for Page Layout Option
 */

require get_template_directory() . '/paragonthemes/metabox/metabox-defaults.php';

/**
 * Metabox for Fontawesome Class
 */

require get_template_directory() . '/paragonthemes/metabox/metabox-icon.php';


/*
* Including Custom Widget Files
=====================================
/**
 * Custom quote Widget
 */
require get_template_directory() . '/paragonthemes/widget/quote-widget.php';

/**
 * Custom Welcome Message Widget
 */
require get_template_directory() . '/paragonthemes/widget/welcome-msg-widget.php';

/**
 * Custom Feature Widget
 */
require get_template_directory() . '/paragonthemes/widget/feature-widget.php';

/**
 * Custom Services Widget
 */
require get_template_directory() . '/paragonthemes/widget/services-widget.php';

/**
 * Custom Mission Widget
 */
require get_template_directory() . '/paragonthemes/widget/mission-widget.php';

/**
 * Custom Recent Post Widget
 */
require get_template_directory() . '/paragonthemes/widget/recent-post-widget.php';

/**
 * Custom Testimonial  Widget
 */
require get_template_directory() . '/paragonthemes/widget/testimonial-widget.php';


/**
 * Custom Our Work Widget
 */
require get_template_directory() . '/paragonthemes/widget/our-work-widget.php';

/**
 * Custom Our Team Widget
 */
require get_template_directory() . '/paragonthemes/widget/team-widget.php';




<?php
/**
 * Nexas functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */

if ( !function_exists( 'nexas_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function nexas_setup()
    {
        /*
         * Make theme available for translation.
        */

        load_theme_textdomain( 'nexas' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        //Add Excerpt field in page
        add_post_type_support( 'page', 'excerpt' );       
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary'     => esc_html__('Primary', 'nexas'),
            'social-link' => esc_html__('Social Link', 'nexas'),
        ));

        /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
        add_theme_support('html5', array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));


        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('nexas_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'nexas_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nexas_content_width()
{
    $GLOBALS['content_width'] = apply_filters('nexas_content_width', 640);
}

add_action('after_setup_theme', 'nexas_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nexas_widgets_init()
{
    register_sidebar(array(
        'name'         => esc_html__('Sidebar', 'nexas'),
        'id'           => 'sidebar-1',
        'description'  => esc_html__('Add widgets here.', 'nexas'),
        'before_title' => '<h2 class="widget-title">',
        'after_title'  => '</h2>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Home Page Widget Area', 'nexas'),
        'id'            => 'nexas-home-page',
        'description'   => esc_html__('Add widgets here to appear in Home Page. First Select Front Page and Blog Page From Appearance > Homepage Settings', 'nexas'),
        'before_widget' => '',
        'after_widget'  => '',

    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'nexas'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here.', 'nexas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'nexas'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here.', 'nexas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'nexas'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here.', 'nexas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Footer 4', 'nexas'),
        'id'            => 'footer-4',
        'description'   => esc_html__('Add widgets here.', 'nexas'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}

add_action('widgets_init', 'nexas_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function nexas_scripts()
{

    /*Bootstrap*/
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.5.1');

    wp_enqueue_style('bootstrap-dropdownhover', get_template_directory_uri() . '/assets/css/bootstrap-dropdownhover.min.css', array(), '4.5.0');

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0');

    /*google font  */
    wp_enqueue_style('nexas-googleapis', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Source+Sans+Pro:300,400,600', array(), null);

    /* Animation CSS Enqueue */
    $animation_options = nexas_get_option('nexas_animation_option');
    if( $animation_options == 0 ){
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '4.5.0');
    }
    
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '4.5.0');

    wp_enqueue_style('nexas-page-builder', get_template_directory_uri() . '/assets/css/page-builder.css', array(), '4.5.0');

    wp_enqueue_style('nexas-style', get_stylesheet_uri());

    wp_enqueue_style('nexas-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '4.5.0');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('bootstrap-dropdownhover', get_template_directory_uri() . '/assets/js/bootstrap-dropdownhover.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('jquery-isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.js', array('jquery'), '20151215', true);

    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '20151215', true);

    wp_enqueue_script('nexas-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '20151215', true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'nexas_scripts');

/**
 * Implement the default Function.
 */
require get_template_directory() . '/paragonthemes/customizer/default.php';

/**
 * Implement the default file.
 */
require get_template_directory() . '/paragonthemes/core/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/paragonthemes/core/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/paragonthemes/core/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/paragonthemes/core/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/paragonthemes/core/jetpack.php';

/**
 * Load Bootstrap Navwalder class.
 */
require get_template_directory() . '/paragonthemes/core/wp_bootstrap_navwalker.php';

/**
 * Customizer Home layout.
 */
require get_template_directory() . '/paragonthemes/layouts/homepage-layout/nexas-home-layout.php';

/**
 * Reset css
 */
require get_template_directory() . '/paragonthemes/hooks/reset-css.php';

/**
 * Customizer Home layout.
 */
require get_template_directory() . '/paragonthemes/core/theme-function.php';

/**
 * Load Dynamic css
 */

include get_template_directory() . '/paragonthemes/hooks/dynamic-css.php';

/**
 * Load Cusomizer Repeater
 */

include get_template_directory() . '/paragonthemes/customizer-repeater/customizer-control-repeater.php';

/**
 * Load tgm for this theme
 */
require get_template_directory() . '/paragonthemes/library/tgm/class-tgm-plugin-activation.php';

/**
 * Plugin recommendation using TGM
*/
require get_template_directory() . '/paragonthemes/hooks/tgm.php';

/**
 * Dummy File Load 
*/
require get_template_directory() . '/paragonthemes/dummy-data/dummy-file.php';

/**
 * Load about.
 */
if ( is_admin() ) {
   
include get_template_directory() . '/paragonthemes/about/about.php';
include get_template_directory() . '/paragonthemes/about/class-about.php';
}
/**
 * define size of logo.
 */

if (!function_exists('nexas_custom_logo_setup')) :
    function nexas_custom_logo_setup()
    {
        add_theme_support('custom-logo', array(
            'height'      => 35,
            'width'       => 190,
            'flex-height' => true,
            'flex-width'  => true,
        ));
    }

    add_action('after_setup_theme', 'nexas_custom_logo_setup');
endif;

/**
 * Exclude category in blog page
 *
 * @since Nexas 1.0.0
 *
 * @param null
 * @return int
 */
if (!function_exists('nexas_exclude_category_in_blog_page')) :
    function nexas_exclude_category_in_blog_page($query)
    {

        if ($query->is_home && $query->is_main_query()) 
        {
            $catid = nexas_get_option('nexas_exclude_cat_blog_archive_option');
            $exclude_categories = $catid;
            if (!empty($exclude_categories)) 
            {
                $cats = explode(',', $exclude_categories);
                $cats = array_filter($cats, 'is_numeric');
                $string_exclude = '';
                echo $string_exclude;
                if (!empty($cats))
                {
                    $string_exclude = '-' . implode(',-', $cats);
                    $query->set('cat', $string_exclude);
                }
            }
        }
        return $query;
    }
endif;
add_filter('pre_get_posts', 'nexas_exclude_category_in_blog_page');


/**
 * Load Dynamic css.
 */
$dynamic_css_options = nexas_get_option('nexas_color_reset_option');

if ( $dynamic_css_options == "do-not-reset" || $dynamic_css_options == "") 
{

    include get_template_directory() . '/paragonthemes/hooks/dynamic-css.php';

}
 elseif ($dynamic_css_options == "reset-all")
 {
    do_action('nexas_colors_reset');
 }


/**
 * Run ajax request.
 */
if ( ! function_exists('nexas_wp_pages_plucker') ) :

    /**
    * Sending pages with ids
    */
    function nexas_wp_pages_plucker()
    {
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );

        $ids = wp_list_pluck( $pages, 'post_title', 'ID' );

        return wp_send_json($ids);
    }

endif;
add_action( 'wp_ajax_nexas_wp_pages_plucker', 'nexas_wp_pages_plucker' );
add_action( 'wp_ajax_nopriv_nexas_wp_pages_plucker', 'nexas_wp_pages_plucker' );
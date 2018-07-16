<?php
/**
 * WordPress Administration Template Header
 *
 * @package WordPress
 * @subpackage Administration
 */

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
if ( ! defined( 'WP_ADMIN' ) )
require_once( dirname( __FILE__ ) . '/admin.php' );

/**
* In case admin-header.php is included in a function.
*
* @global string    $title
* @global string    $hook_suffix
* @global WP_Screen $current_screen
* @global WP_Locale $wp_locale
* @global string    $pagenow
* @global string    $update_title
* @global int       $total_update_count
* @global string    $parent_file
*/
global $title, $hook_suffix, $current_screen, $wp_locale, $pagenow,
$update_title, $total_update_count, $parent_file;

if(!is_network_admin()&&!is_user_admin()&&!is_blog_admin())
{
	?>
	<script>
	location.replace('http://140.125.33.33')
	</script>
	<?
}
// Catch plugins that include admin-header.php before admin.php completes.
if ( empty( $current_screen ) )
set_current_screen();

get_admin_page_title();
$title = esc_html( strip_tags( $title ) );

if ( is_network_admin() ) {
/* translators: Network admin screen title. 1: Network name */
$admin_title = sprintf( __( 'Network Admin: %s' ), esc_html( get_network()->site_name ) );
} elseif ( is_user_admin() ) {
/* translators: User dashboard screen title. 1: Network name */
$admin_title = sprintf( __( 'User Dashboard: %s' ), esc_html( get_network()->site_name ) );
} else {
$admin_title = get_bloginfo( 'name' );
}

if ( $admin_title == $title ) {
/* translators: Admin screen title. 1: Admin screen name */
$admin_title = sprintf( __( '%1$s &#8212; WordPress' ), $title );
} else {
/* translators: Admin screen title. 1: Admin screen name, 2: Network or site name */
$admin_title = sprintf( __( '%1$s &lsaquo; %2$s &#8212; WordPress' ), $title, $admin_title );
}

/**
* Filters the title tag content for an admin page.
*
* @since 3.1.0
*
* @param string $admin_title The page title, with extra context added.
* @param string $title       The original page title.
*/
$admin_title = apply_filters( 'admin_title', $admin_title, $title );

wp_user_settings();

_wp_admin_html_begin();
?>
<title><?php echo $admin_title; ?></title>
<?php

wp_enqueue_style( 'colors' );
wp_enqueue_style( 'ie' );
wp_enqueue_script('utils');
wp_enqueue_script( 'svg-painter' );

$admin_body_class = preg_replace('/[^a-z0-9_-]+/i', '-', $hook_suffix);
?>
<script type="text/javascript">
addLoadEvent = function(func){if(typeof jQuery!="undefined")jQuery(document).ready(func);else if(typeof wpOnload!='function'){wpOnload=func;}else{var oldonload=wpOnload;wpOnload=function(){oldonload();func();}}};
var ajaxurl = '<?php echo admin_url( 'admin-ajax.php', 'relative' ); ?>',
pagenow = '<?php echo $current_screen->id; ?>',
typenow = '<?php echo $current_screen->post_type; ?>',
adminpage = '<?php echo $admin_body_class; ?>',
thousandsSeparator = '<?php echo addslashes( $wp_locale->number_format['thousands_sep'] ); ?>',
decimalPoint = '<?php echo addslashes( $wp_locale->number_format['decimal_point'] ); ?>',
isRtl = <?php echo (int) is_rtl(); ?>;
</script>
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<?php

/**
* Enqueue scripts for all admin pages.
*
* @since 2.8.0
*
* @param string $hook_suffix The current admin page.
*/
do_action( 'admin_enqueue_scripts', $hook_suffix );

/**
* Fires when styles are printed for a specific admin page based on $hook_suffix.
*
* @since 2.6.0
*/
do_action( "admin_print_styles-{$hook_suffix}" );

/**
* Fires when styles are printed for all admin pages.
*
* @since 2.6.0
*/
do_action( 'admin_print_styles' );

/**
* Fires when scripts are printed for a specific admin page based on $hook_suffix.
*
* @since 2.1.0
*/
do_action( "admin_print_scripts-{$hook_suffix}" );

/**
* Fires when scripts are printed for all admin pages.
*
* @since 2.1.0
*/
do_action( 'admin_print_scripts' );

/**
* Fires in head section for a specific admin page.
*
* The dynamic portion of the hook, `$hook_suffix`, refers to the hook suffix
* for the admin page.
*
* @since 2.1.0
*/
do_action( "admin_head-{$hook_suffix}" );

/**
* Fires in head section for all admin pages.
*
* @since 2.1.0
*/
do_action( 'admin_head' );

if ( get_user_setting('mfold') == 'f' )
$admin_body_class .= ' folded';

if ( !get_user_setting('unfold') )
$admin_body_class .= ' auto-fold';

if ( is_admin_bar_showing() )
$admin_body_class .= ' admin-bar';

if ( is_rtl() )
$admin_body_class .= ' rtl';

if ( $current_screen->post_type )
$admin_body_class .= ' post-type-' . $current_screen->post_type;

if ( $current_screen->taxonomy )
$admin_body_class .= ' taxonomy-' . $current_screen->taxonomy;

$admin_body_class .= ' branch-' . str_replace( array( '.', ',' ), '-', floatval( get_bloginfo( 'version' ) ) );
$admin_body_class .= ' version-' . str_replace( '.', '-', preg_replace( '/^([.0-9]+).*/', '$1', get_bloginfo( 'version' ) ) );
$admin_body_class .= ' admin-color-' . sanitize_html_class( get_user_option( 'admin_color' ), 'fresh' );
$admin_body_class .= ' locale-' . sanitize_html_class( strtolower( str_replace( '_', '-', get_user_locale() ) ) );

if ( wp_is_mobile() )
$admin_body_class .= ' mobile';

if ( is_multisite() )
$admin_body_class .= ' multisite';

if ( is_network_admin() )
$admin_body_class .= ' network-admin';

$admin_body_class .= ' no-customize-support no-svg';
include("../wp-includes/connection.php")
?>

<link rel="stylesheet" type="text/css" href="../wp-includes/css/style.css">
<script src="../wp-includes/js/js.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js'></script>
<script src="https://github.com/agershun/alasql/blob/develop/src/17alasql.js"></script>
<script src="../wp-includes/js/socket.io.js"></script>
</head>
<?php
/**
* Filters the CSS classes for the body tag in the admin.
*
* This filter differs from the {@see 'post_class'} and {@see 'body_class'} filters
* in two important ways:
*
* 1. `$classes` is a space-separated string of class names instead of an array.
* 2. Not all core admin classes are filterable, notably: wp-admin, wp-core-ui,
*    and no-js cannot be removed.
*
* @since 2.3.0
*
* @param string $classes Space-separated list of CSS classes.
*/
$admin_body_classes = apply_filters( 'admin_body_class', '' );
$d = date("Y-m-d",time());
$date = new DateTime($d);
$lower = $date->format("U");
$upper = $lower+86400;
?>
<body class="wp-admin wp-core-ui no-js <?php echo $admin_body_classes . ' ' . $admin_body_class; ?>" onload="init('<?=$upper-1?>','<?=$lower?>')">
<div id="all" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:auto; height:auto; z-index:100000; display:none;" onclick="clos()"></div>
<div id="cover" style="position:fixed; top:40px; bottom:10px; left:0px; right:0px; width:auto; height:auto; background-color:rgba(0,0,0,0.8); z-index:100001; border-radius:10px; display:none; border:rgba(0,0,0,0.3) solid 10px;">
	<center>
	<h1 style="color:#FFF;">Device Control</h1><hr width="350">
	<div id="status_div" style="width:800px; height:auto;"><canvas id="Chart" style="z-index:100002;"></canvas></div><br>
	<ul style="display:inline;">
		<li style="display:inline;">
			<select class="tex" id="Year" style="margin: 0px 5px 0px 5px;" onchange="mon_ini()"></select>
		</li>
		<li style="display:inline;">
			<select class="tex" id="Month" onchange="day_ini()" style="margin: 0px 5px 0px 5px;"></select>
		</li>
		<li style="display:inline;">
			<select class="tex" id="Day" style="margin: 0px 5px 0px 5px;"></select>
		</li>
		<li style="display:inline;">
			<select class="tex" id="Hour" style="margin: 0px 5px 0px 5px;">
			<?
			for($h=0;$h<=23;$h++){
				?><option value="<?=$h?>"><?=$h?>時</option><?
			}
			?>
			</select>
		</li>
		<li style="display:inline;">
			<select class="tex" id="Min" style="margin: 0px 5px 0px 5px;">
			<?
                        for($m=0;$m<=59;$m++){
                                ?><option value="<?=$m?>"><?=$m?>分</option><?
                        }
                        ?>
			</select>
		</li>
		<li id="on_off" style="display:inline;">
			
		</li>
	</ul>
	</center>
</div>
<script type="text/javascript">
	document.body.className = document.body.className.replace('no-js','js');
</script>
<style>
.btn
{
    color: #FFF;
    font-size: 90%;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
    background: #999;
    border: none;
    border-bottom: 2px solid rgba( 0, 0, 0, 0.2 );
    border-radius: 3px;
    cursor: pointer;
    -webkit-appearance: button;
    padding: 8px 30px;
    transition: all 0.3s ease;
}
</style>
<?php
// Make sure the customize body classes are correct as early as possible.
if ( current_user_can( 'customize' ) ) {
	wp_customize_support_script();
}
?>

<div id="wpwrap">
<?php require(ABSPATH . 'wp-admin/menu-header.php'); ?>
<div id="wpcontent">
<?php
/**
 * Fires at the beginning of the content section in an admin page.
 *
 * @since 3.0.0
 */
do_action( 'in_admin_header' );
?>

<div id="wpbody" role="main">
<?php
unset($title_class, $blog_name, $total_update_count, $update_title);

$current_screen->set_parentage( $parent_file );

?>

<div id="wpbody-content" aria-label="<?php esc_attr_e('Main content'); ?>" tabindex="0">
<?php

//$current_screen->render_screen_meta();

if ( is_network_admin() ) {
	/**
	 * Prints network admin screen notices.
	 *
	 * @since 3.1.0
	 */
	do_action( 'network_admin_notices' );
} elseif ( is_user_admin() ) {
	/**
	 * Prints user admin screen notices.
	 *
	 * @since 3.1.0
	 */
	do_action( 'user_admin_notices' );
} else {
	/**
	 * Prints admin screen notices.
	 *
	 * @since 3.1.0
	 */
	do_action( 'admin_notices' );
}

/**
 * Prints generic admin screen notices.
 *
 * @since 3.1.0
 */
do_action( 'all_admin_notices' );

if ( $parent_file == 'options-general.php' )
	require(ABSPATH . 'wp-admin/options-head.php');

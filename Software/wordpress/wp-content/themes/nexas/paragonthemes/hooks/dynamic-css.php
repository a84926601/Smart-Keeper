<?php
/**
 * Dynamic css
 *
 * @package Paragon Themes
 * @subpackage Nexas
 *
 * @param null
 * @return void
 *
 */

if ( !function_exists('nexas_dynamic_css') ):
    function nexas_dynamic_css(){

    $nexas_top_header_color    = esc_attr( nexas_get_option('nexas_top_header_background_color') );

    $nexas_top_footer_color    = esc_attr( nexas_get_option('nexas_top_footer_background_color') );

    $nexas_bottom_footer_color = esc_attr( nexas_get_option('nexas_bottom_footer_background_color') );

    $nexas_primary_color       = esc_attr( nexas_get_option('nexas_primary_color') );


    $custom_css                = '';


    /*====================Dynamic Css =====================*/
    
    $custom_css .= ".top-header{
         background-color: " . $nexas_top_header_color . ";}
    ";

    $custom_css .= ".footer-top{
         background-color: " . $nexas_top_footer_color . ";}
    ";

    $custom_css .= ".footer-bottom{
         background-color: " . $nexas_bottom_footer_color . ";}
    ";

    $custom_css .= ".section-0-background,
     .btn-primary,
     hr,
     header .dropdown-menu > li > a:hover,
     .dropdown-menu > .active > a, 
     .dropdown-menu > .active > a:focus, 
     .dropdown-menu > .active > a:hover,
     button, 
     .comment-reply-link, 
     input[type='button'], 
     input[type='reset'], 
     input[type='submit'],
     .section-1-box-icon-background,
     #quote-carousel a.carousel-control,
     header .navbar-toggle,
     .section-10-background,
     .footer-top .submit-bgcolor,
     .nav-links .nav-previous a, 
     .nav-links .nav-next a,
     .section1 .border::before,
     .section1 .border::after,
     .portfolioFilter a.current,
     #section-12 .filter-box .lower-box a i,
     .section-2-box-left .border.left::before,
     .section-2-box-left .border::after,
     .comments-area .submit,
     .comments-area .comment-body .reply a,
     .navbar-default .navbar-toggle:focus, 
     .navbar-default .navbar-toggle:hover,
     .inner-title,.woocommerce span.onsale,
     .woocommerce nav.woocommerce-pagination ul li a:focus,
     .woocommerce nav.woocommerce-pagination ul li a:hover,
     .woocommerce nav.woocommerce-pagination ul li span.current,
     .woocommerce a.button, .woocommerce #respond input#submit.alt, 
     .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt
      {
       background-color: " . $nexas_primary_color . ";
      color: #FFF;

}
    ";

    $custom_css .= "
    
    .section-4-box-icon-cont i,
    header .navbar-menu .navbar-nav > li > a:hover, 
    header .navbar-menu .navbar-nav > li > a:active,
    header .navbar-menu .navbar-nav>.open>a,
    header .navbar-menu .navbar-nav>.open>a:focus,
    header .navbar-menu .navbar-nav>.open>a:hover,
    .btn-seconday,
    .section-14-box .date span, 
    .section-14-box .author-post a,
    .btn-primary:hover,
    .widget ul li a:hover,
    .footer-top ul li a:hover,
    .section-0-btn-cont .btn:hover,
    .footer-top .widget_recent_entries ul li:hover:before,
    .footer-top .widget_nav_menu ul li:hover:before,
    .footer-top .widget_archive ul li:hover:before,
    .navbar-default .navbar-nav > .active > a, 
    .navbar-default .navbar-nav > .active > a:focus, 
    .navbar-default .navbar-nav > .active > a:hover

    {
        color: " . $nexas_primary_color . ";}
    ";

    $custom_css .= ".section-14-box .underline,
   .item blockquote img,
   .widget .widget-title,
   .btn-primary,
   .portfolioFilter a,
   .btn-primary:hover,
   button, 
   .comment-reply-link, 
   input[type='button'], 
   input[type='reset'], 
   input[type='submit'],
   .testimonials .content .avatar,
   #quote-carousel .carousel-control.left, 
   #quote-carousel .carousel-control.right,
   header .navbar-menu .navbar-right .dropdown-menu,
   .woocommerce nav.woocommerce-pagination ul li a:focus,
   .woocommerce nav.woocommerce-pagination ul li a:hover,
   .woocommerce nav.woocommerce-pagination ul li span.current
   .woocommerce a.button, .woocommerce #respond input#submit.alt, 
   .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt
   {
       border-color: " . $nexas_primary_color . ";}
    ";
    /*------------------------------------------------------------------------------------------------- */

    /*custom css*/

    wp_add_inline_style('nexas-style', $custom_css);

}
endif;
add_action('wp_enqueue_scripts', 'nexas_dynamic_css', 99);
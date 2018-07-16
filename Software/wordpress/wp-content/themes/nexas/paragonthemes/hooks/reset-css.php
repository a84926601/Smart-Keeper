<?php 

//=============================================================
// Color reset
//=============================================================
if ( ! function_exists( 'nexas_reset_colors' ) ) :

    function nexas_reset_colors($data) {

         set_theme_mod('nexas_top_header_background_color','#ec5538');

         set_theme_mod('nexas_top_footer_background_color','#1A1E21');

         set_theme_mod('nexas_bottom_footer_background_color','#111315');

         set_theme_mod('nexas_primary_color','#ec5538');

         set_theme_mod('nexas_color_reset_option','do-not-reset');
         
    }

endif;
add_action( 'nexas_colors_reset','nexas_reset_colors', 10 );



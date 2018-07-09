<?php

if( ! function_exists( 'nexas_home_page_section_hook' ) ):
     
      function nexas_home_page_section_hook() { 
     
           get_template_part( 'paragonthemes/home-section-parts/section', 'slider'); 
           
     }
   endif;
   
    add_action( 'nexas_home_page_section', 'nexas_home_page_section_hook', 10 );
?>
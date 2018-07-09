<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
get_header();
$nexas_designlayout      = nexas_get_option( 'nexas_sidebar_layout_option' );
 ?>    
    <section id="inner-title" class="inner-title" >
        
        <div class="container">
        
            <div class="row">
        
                <div class="col-md-8">
        
                    <h2><?php printf(esc_html__('Search Results for: %s', 'nexas'), '<span>' . get_search_query() . '</span>'); ?></h2>
        
                </div>
            </div>
        </div>
    </section>

    <section id="section16" class="section16">
        <div class="container">
            <div class="row">
                <div class="col-sm-<?php if ($nexas_designlayout == 'no-sidebar') {
                    echo "12";
                } else {
                    echo "9";
                } ?> col-md-<?php if ($nexas_designlayout == 'no-sidebar') {
                    echo "12";
                } else {
                    echo "9";
                } ?> left-block">
                    <?php
                    if (have_posts()) : ?>

                        <?php
                        /* Start the Loop */
                        while (have_posts()) : the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'search');

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif; ?>

                </div><!-- div -->
                <?php if ($nexas_designlayout != 'no-sidebar') { ?>
               
                    <div class="col-md-3">
                       
                        <?php get_sidebar(); ?>
               
                    </div>
               
                <?php } ?>
            </div><!-- div -->
        </div>
    </section>

<?php get_footer();

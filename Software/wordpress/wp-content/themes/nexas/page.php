<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */

get_header();
 $nexas_designlayout = get_post_meta(get_the_ID(), 'nexas_sidebar_layout', true  );
 ?>
    <section id="inner-title" class="inner-title"  <?php echo $header_style; ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-8"><h2><?php the_title(); ?></h2></div>
            </div>
        </div>
    </section>
    <section id="section16" class="section16 gray-bg">
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
                    while (have_posts()) : the_post();

                        get_template_part('template-parts/content', 'page');

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </div><!-- div -->
                <?php

                 $nosidebar = 0;
              
                 $sidebardesignlayout   = esc_attr(nexas_get_option('nexas_sidebar_layout_option' ));

                if (($nexas_designlayout == 'default-sidebar'))
                {
                    $nosidebar = 1;
                }
              
                elseif( $sidebardesignlayout != 'no-sidebar'){
                    $nosidebar = 0;
                }

                if (($nosidebar == 0))
                {
                    ?>

                    <div class="col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>
            </div><!-- div -->
        </div>
    </section>

<?php get_footer();

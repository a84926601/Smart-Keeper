<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
get_header();

$blog_page_title    = nexas_get_option('nexas_blog_title_option');
$nexas_designlayout = nexas_get_option('nexas_sidebar_layout_option');
?>
    <section id="inner-title" class="inner-title" >
        
        <div class="container">
            
            <div class="row">
                
                <div class="col-md-7">
                
                    <h2><?php echo esc_html( $blog_page_title ); ?></h2>
                
                </div>
        
            </div>
        
        </div>
   
    </section>
   
    <section id="section14" class="section-margine gray-bg">
   
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
                    if (have_posts()) :
                        /* Start the Loop */
                        while (have_posts()) : the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', get_post_format());

                        endwhile;

                        the_posts_navigation();

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif; ?>

                </div><!--div -->
                <?php if ($nexas_designlayout != 'no-sidebar') { ?>
                    <div class="col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                <?php } ?>

            </div>
        </div><!-- div -->
    </section>

<?php get_footer();

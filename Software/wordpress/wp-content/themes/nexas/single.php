<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
get_header();
$nexas_designlayout      = get_post_meta(get_the_ID(), 'nexas_sidebar_layout', true  ); ?> 

 <section id="inner-title" class="inner-title" >
        <div class="container">
            <div class="row">
                <div class="col-md-8"><h2><?php the_title(); ?></h2></div>
            </div>
        </div>
</section>

<section id="section14" class="section-margine gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-<?php if ( $nexas_designlayout == 'no-sidebar') {
                echo "12";
            } else {
                echo "9";
            } ?> col-md-<?php if ( $nexas_designlayout == 'no-sidebar' ) {
                echo "12";
            } else {
                echo "9";
            } ?> left-block">
                <?php
                while (have_posts()) : the_post();
                    
                    get_template_part('template-parts/content', 'single');
                    
                    echo '<div class="entry-box">';
                    
                        the_post_navigation(array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next', 'nexas') . '</span> ' .
                                '<span class="screen-reader-text">' . esc_html__('Next post:', 'nexas'),
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Previous', 'nexas') . '</span> ' .
                                '<span class="screen-reader-text">' . esc_html__('Previous post:', 'nexas'),
                        ));

                        echo '<div class="comment-form-container">';
                        
                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                        echo '</div>';
                    echo '</div>';
                endwhile; // End of the loop.
                ?>
            </div>
            <?php
             $sidebardesignlayout = esc_attr(nexas_get_option( 'nexas_sidebar_layout_option' ) );
             
             if ( $sidebardesignlayout != 'no-sidebar') { ?>
             
                <div class="col-md-3">
            
                    <?php get_sidebar(); ?>
             
                </div>
            
            <?php } ?>
        </div>
    </div>
</section>
<?php
get_footer(); ?>

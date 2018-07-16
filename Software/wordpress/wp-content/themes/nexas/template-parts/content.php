<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
$description_from   = nexas_get_option( 'nexas_blog_excerpt_option');
$description_length = nexas_get_option( 'nexas_description_length_option') ;
$readme_text        = nexas_get_option( 'nexas_read_more_text_blog_archive_option');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
     <div   class="section-14-box wow fadeInUp <?php if( !has_post_thumbnail() ) { echo "no-image"; } ?>">
            <figure>
                <?php
                if( has_post_thumbnail() ) 
                {
                    the_post_thumbnail('full', array('class' => 'img-responsive') );
                }
                ?>
            </figure>

            <div class="entry-box">
                  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            
                  <div class="date">
                      <span><?php echo esc_html( get_the_date('M') ); ?></span>
                      <span><?php echo esc_html( get_the_date('d') ); ?></span>
                      <span><?php echo esc_html( get_the_date('Y') ); ?></span>
                  </div>


               <?php
               echo "<p>";
               if( $description_from == 'content' )
               {
                   echo esc_html( wp_trim_words( get_the_content(),$description_length) );
               }
               else
               {
                   echo esc_html( wp_trim_words( get_the_excerpt(),$description_length) );
               }
               echo "</p>";
               ?>

              <!--read more-->
                 <?php 
                  if( !empty( $readme_text) )
                  {
                 ?>
                      <div class="text-left">
                          <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php echo esc_html( $readme_text ); ?></a>
                      </div>
            <?php }

                 wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:','nexas'),
                        'after'  => '</div>',
                      ) );
                    ?>
              </div>
       </div>
  </article><!-- #post-## -->

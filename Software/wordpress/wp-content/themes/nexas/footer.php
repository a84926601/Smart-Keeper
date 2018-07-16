<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
$copyright = nexas_get_option('nexas_copyright');

if ( is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) {

    $count = 0;
  
    for ( $i = 1; $i <= 4; $i++ )
        {
          if ( is_active_sidebar( 'footer-' . $i ) )
                {
                    $count++;
                }
        }
       
        $column = 3;
       
        if( $count == 4 ) 
        {
            $column = 3;  
       
        }

        elseif( $count == 3)
        {
                $column = 4;
        }
        
        elseif( $count == 2) 
        {
                $column = 6;
        }
        
        elseif( $count == 1) 
        {
                $column = 12;
        }

    ?>

    <section id="footer-top" class="footer-top">
        <div class="container">
            <div class="row">
                <?php
                    for ( $i = 1; $i <= 4 ; $i++ )
                    {
                        
                        if ( is_active_sidebar( 'footer-' . $i ) )
                        {

                ?>
                            <div class="col-md-3">
                                <div class="footer-top-box wow fadeInUp">
                                    <?php dynamic_sidebar( 'footer-' . $i ); ?>
                                </div>

                            </div>
                 <?php  }
                     
                     }       
                     
                     ?>
               
            </div>
        </div>
    </section>

<?php } ?>

<section id="footer-bottom" class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                   <div class="copyright">
                        <?php echo wp_kses_post( $copyright ); ?>
                    </div>
                    <div class="footer-credit">
                        <p><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nexas' ) ); ?>"><?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf( esc_html__( 'Proudly powered by %s', 'nexas' ), 'WordPress' );
                       ?></a>
                       <span class="sep"> | </span>
                       <?php
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf( esc_html__( 'Theme: %1$s by %2$s', 'nexas' ), 'Nexas', '<a href="http://paragonthemes.com">Paragon Themes</a>' );
                       ?></p>
                    </div>
            </div>
            <?php
                /*
                /* Footer Go to Top
                */
                do_action('nexas_go_to_top_hook');
            ?>
      </div>
    </div>
</section>
<?php wp_footer(); ?>

</body>
</html>

<?php
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
$nexas_slider_section_option      = nexas_get_option('nexas_homepage_slider_option');

if ( $nexas_slider_section_option != 'hide' ) {

    $nexas_slides_data = json_decode( nexas_get_option('nexas_slider_option'));
    $post_in = array();

    $i=0;
        $slides_other_data = array();
        if( is_array( $nexas_slides_data ) ){
            foreach ( $nexas_slides_data as $slides_data ){
                if( isset( $slides_data->selectpage ) && !empty( $slides_data->selectpage ) ){
                    $post_in[] = $slides_data->selectpage;
                    $slides_other_data[$slides_data->selectpage] = array(
                           'button_text' =>$slides_data->button_text,
                           'button_link' =>$slides_data->button_link,
                           
                    );

                   $i++; 
                }

                
            }
        }
        if( !empty( $post_in )) :
            $nexas_slider_page_args   = array(
                'post__in'            => $post_in,
                'orderby'             => 'post__in',
                'posts_per_page'      => count( $post_in ),
                'post_type'           => 'page',
                'no_found_rows'       => true,
                'post_status'         => 'publish'
            );
            $slider_query = new WP_Query( $nexas_slider_page_args );
            /*The Loop*/
            if ( $slider_query->have_posts() ):
                ?> 
        <section id="slider" class="slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Carousel indicators -->              

                <ol class="carousel-indicators">
                    <?php
                    if ($i > 1) {

                        for ($j = 1; $j <= $i; $j++) {
                            ?>
                            <li data-target="#myCarousel" data-slide-to="<?php echo esc_attr($j); ?>"
                                class=" <?php if ($j == 0) {
                                    echo 'active';
                                } ?>">
                            </li>

                        <?php }
                    } ?>
                </ol>

                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    <!--1st item start-->
                    <?php
                    $k = 0;
                     while( $slider_query->have_posts() ):$slider_query->the_post();

                          

                            $slides_single_data = $slides_other_data[get_the_ID()]; 
                    ?>
                          
                                <div class="item <?php if ($k == 0) {
                                    echo "active";
                                } ?>">
                          
                                    <?php if ( has_post_thumbnail() ) {
                                      $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                                      
                                       ?>
                                     
                                        <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive" alt="<?php the_title_attribute(); ?>">
                                    <?php } ?>
                                    
                                        <div class="carousel-caption">
                                            <div class="container">
                                            <h1 class="color-white effect-1-2"><?php echo esc_html( wp_trim_words( get_the_title(), 4) ); ?></h1>
                                            <h3 class="color-white effect-1-1"><?php echo esc_html( wp_trim_words( get_the_content(), 10) ); ?> </h3>
                                        
                                            <?php
                                             if( !empty( $slides_single_data['button_text'] ) ){
                                                ?>
                                                <div class="effect-1-3">
                                                    <a href="<?php echo esc_url($slides_single_data['button_link']); ?>" class="btn btn-primary">
                                                        <?php echo esc_html($slides_single_data['button_text'] ) ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $k++;
                         endwhile;
                        wp_reset_postdata();                    
                    ?>

                    <!--1st item end-->
                </div>
                <!-- Carousel controls -->

                <?php
                if ( $i > 1 ) {
                    
                    ?>
                    
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <span class="carousel-arrow">
                            <i class="fa fa-angle-left fa-2x"></i>
                        </span>
                    </a>
                    
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <span class="carousel-arrow">
                            <i class="fa fa-angle-right fa-2x"></i>
                        </span>
                    </a>

                <?php } ?>
            </div>
        </section>
    <?php  endif;  endif;
} ?>
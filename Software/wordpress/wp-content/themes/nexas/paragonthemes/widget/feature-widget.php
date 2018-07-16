<?php
/**
 * Class for adding Our Features Section Widget
 *
 * @package Paragon Themes
 * @subpackage Nexas
 * @since 1.0.0
 */
if( !class_exists( 'Nexas_Feature_Widget') ){

    class Nexas_Feature_Widget extends WP_Widget
    {
        private function defaults()
        {
            /*defaults values for fields*/
            $defaults = array(
                 
                 'features_title'      => esc_html__('CORE FEATURES', 'nexas'),
                 'features_background' => '',
                  'features' => ''
            );
            return $defaults;
        }

        public function __construct()
        
        {
            parent::__construct(
                /*Widget ID*/
                'nexas_feature_widget',
                /*Widget name*/
                 esc_html__('Nexas Feature Widget', 'nexas'),
                 /*Widget Description*/
                 array('description' => esc_html__('Nexas Feature Section', 'nexas'))
            );
        }
        
        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         *
         * @return void
         *
         */

        public function widget( $args, $instance )
        {
            if ( !empty( $instance ) ) 
             {
                $instance = wp_parse_args( (array) $instance, $this->defaults() );
                /*default values*/
             
                $features_title = apply_filters( 'widget_title', !empty( $instance['features_title'] ) ? esc_html( $instance['features_title'] ) : '', $instance, $this->id_base);
             
                $features_background  = esc_url($instance['features_background']);

                $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();

                echo $args['before_widget'];
             
                ?>
                <section id="section1" class="section1">
                    <?php if (isset($features) && !empty($features['main'])) : ?>    
                    <div class="container-fulid">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-xs-12">
                                <div class="item-holder" style="background: url(<?php echo $features_background; ?>);background-repeat: no-repeat;"> 
                                </div>                                        
                            </div>
                            <div class="col-lg-6 col-md-12 col-xs-12">
                              <div class="section-margine">
                                    <?php if(!empty( $features_title ) ) { ?>
                                    <div class="feature-title">
                                        <div class="sec-title two">
                                            <h2><?php echo esc_html( $features_title );?></h2>
                                            <div class="border left"></div>
                                        </div>
                                    </div>
                                    <?php } 

                                 $post_in = array();

                                if  (count($features) > 0 && is_array($features) )
                                {

                                      $post_in[0] = $features['main'];

                                      foreach ( $features as $our_feature )
                                    {
                                          
                                        if( isset( $our_feature['page_ids'] ) && !empty( $our_feature['page_ids'] ) )

                                           {
                                            
                                               $post_in[] = $our_feature['page_ids'];
                                            
                                            }
                                    }
                                      

                                }     
                                
                                if( !empty( $post_in )) :
                                    $features_page_args = array(
                                            'post__in'            => $post_in,
                                            'orderby'             => 'post__in',
                                            'posts_per_page'      => count( $post_in ),
                                            'post_type'           => 'page',
                                            'no_found_rows'       => true,
                                            'post_status'         => 'publish'
                                    );

                                    $features_query = new WP_Query( $features_page_args );

                                    /*The Loop*/
                                    if ( $features_query->have_posts() ):
                                        $i = 1;
                                        while ( $features_query->have_posts() ):$features_query->the_post();
                                                        
                                              $icon = get_post_meta( get_the_ID(), 'nexas_icon', true );
                                              
                                              ?>
                                              <div class="section-1-box" data-wow-delay=".<?php echo esc_attr($i); ?>">
                                                    <?php
                                                    if(!empty($icon))
                                                    {
                                                    ?>
                                                        <div class="section-1-box-icon-background">
                                                            <i class="fa <?php echo esc_attr($icon); ?>"></i>
                                                        </div>
                                              <?php } ?>
                                              
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
                                              
                                                    <p><?php the_excerpt(); ?></p>
                                              </div>
                                      <?php
                                          endwhile;
                                    endif;
                                    wp_reset_postdata();
                              endif;
                                ?>                                    
                              </div>
                            </div>
                        </div>
                    </div>
                   <?php endif; ?> 
                </section>
                <?php
                echo $args['after_widget'];
            }
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         *
         * @return array
         *
         */
        public function update( $new_instance, $old_instance )
         {
            $instance           = $old_instance;
            
            $instance['features_title'] = (isset($new_instance['features_title'])) ? sanitize_text_field( $new_instance['features_title'] ) : '';
            $instance['features_background'] = esc_url_raw($new_instance['features_background']);

            if (isset($new_instance['features']))
            {
                foreach($new_instance['features'] as $feature){
                  
                  $feature['page_ids'] = absint($feature['page_ids']);
                }
                $instance['features'] = $new_instance['features'];
            }
            
            return $instance;


        }
        /*Widget Backend*/
        public function form( $instance )
        {
            $instance           = wp_parse_args( (array) $instance, $this->defaults() );
            /*default values*/
            $nexas_features_title = esc_attr( $instance[ 'features_title' ] );
            $features_background   = esc_url( $instance['features_background'] );
            $features              = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); 
  
            ?>
           <span class="pt-nexas-additional"> 
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('features_title')); ?>">
                    <?php esc_html_e('Title', 'nexas'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'features_title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'features_title' ) ); ?>" value="<?php echo $nexas_features_title?>">
            </p>

            <label><?php _e( 'Select Pages', 'nexas' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page and Remove. Please do not forget to add Icon and Excerpt  on selected pages.', 'nexas' ); ?></small>
          
              <?php

                if  (count($features) >=  1 && is_array($features) ){
                  
                   $selected = $features['main'];

                }
                else
                {
                  $selected = "";
                }

                $repeater_id   = $this->get_field_id( 'features' ).'-main';
                $repeater_name = $this->get_field_name( 'features'). '[main]';

                $args = array(
                    'selected'          => $selected,
                    'name'              => $repeater_name,
                    'id'                => $repeater_id,
                    'class'             => 'widefat pt-select',
                    'show_option_none'  => __( 'Select Page', 'nexas'),
                    'option_none_value' => 0 // string
                );
                wp_dropdown_pages( $args );
              ?>
              
              <?php
           
            $counter = 0;
           
            if ( count( $features ) > 0 ) {
                foreach( $features as $feature ) {

                    if ( isset( $feature['page_ids'] ) ) { ?>
                      <div class="pt-nexas-sec">
      
                          <?php
        
                            $repeater_id     = $this->get_field_id( 'features' ) .'-'. $counter.'-page_ids';
                            $repeater_name   = $this->get_field_name( 'features' ) . '['.$counter.'][page_ids]';

                            $args = array(
                                'selected'          => $feature['page_ids'],
                                'name'              => $repeater_name,
                                'id'                => $repeater_id,
                                'class'             => 'widefat pt-select',
                                'show_option_none'  => __( 'Select Page', 'nexas'),
                                'option_none_value' => 0 // string
                            );
                            wp_dropdown_pages( $args );
                            ?>

                            <a class="pt-nexas-remove delete"><?php esc_html_e('Remove Section','nexas') ?></a>
                      </div>
                      <?php
                      $counter++;
                   }
                }
            }

            ?>

           </span>
           <a class="pt-nexas-add button" data-id="nexas_feature_widget" id="<?php echo $repeater_id; ?>"><?php _e('Add New Section', 'nexas'); ?></a> 
           <hr>
            <p>
                <label for="<?php echo $this->get_field_id('features_background'); ?>">
                    <?php _e( 'Select Background Image', 'nexas' ); ?>:
                </label>
                <span class="img-preview-wrap" <?php  if ( empty( $features_background ) ){ ?> style="display:none;" <?php  } ?>>
                    <img class="widefat" src="<?php echo esc_url( $features_background ); ?>" alt="<?php esc_attr_e( 'Image preview', 'nexas' ); ?>"  />
                </span><!-- .img-preview-wrap -->
                <input type="text" class="widefat" name="<?php echo $this->get_field_name('features_background'); ?>" id="<?php echo $this->get_field_id('features_background'); ?>" value="<?php echo esc_url( $features_background ); ?>" />
                <input type="button" id="custom_media_button"  value="<?php esc_attr_e( 'Upload Image', 'nexas' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Background Image','nexas'); ?>" data-button="<?php esc_attr_e( 'Select Background Image','nexas'); ?>"/>
                <input type="button" id="remove_media_button" value="<?php esc_attr_e( 'Remove Image', 'nexas' ); ?>" class="button media-image-remove" />
           </p>
            <?php
        }
    }
}

add_action( 'widgets_init', 'nexas_feature_widget' );
function nexas_feature_widget()
{
    register_widget( 'Nexas_Feature_Widget' );
}











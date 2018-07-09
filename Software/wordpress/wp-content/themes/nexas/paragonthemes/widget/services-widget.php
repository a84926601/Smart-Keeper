<?php
/**
 * Class for adding Our Services Section Widget
 *
 * @package Paragon Themes
 * @subpackage Nexas
 * @since 1.0.0
 */
if( !class_exists( 'Nexas_Services_Widget' ) ){
    
    class Nexas_Services_Widget extends WP_Widget
    
    {
        private function defaults()
        {
            /*defaults values for fields*/
            $defaults    = array(
                'title'               => esc_html__('Our Services','nexas'),
                'sub_title'           => esc_html__('Check Our All Services','nexas'),
                'features'            => ''
            );
            return $defaults;
        }

        public function __construct()
        
        {
            parent::__construct(
                /*Base ID of your widget*/
                'nexas_service_widget',
                /*Widget name will appear in UI*/
                esc_html__( 'Nexas Service Widget', 'nexas' ),
                /*Widget description*/
                array( 'description' => esc_html__( 'Nexas Service Section', 'nexas' ) )
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

            if (!empty( $instance ) ) 
            {
                $instance = wp_parse_args( (array ) $instance, $this->defaults ());
                $title        = apply_filters('widget_title', !empty($instance['title']) ? esc_html( $instance['title']): '', $instance, $this->id_base);
                $subtitle     =  esc_html( $instance['sub_title'] );
              
                $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();

                echo $args['before_widget'];
                ?>
                <section id="section4" class="section-margine section-4">
                 <?php if (isset($features) && !empty($features['main'])) : ?>    
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 text-center">
                                <div class="section-title">                               
                                    <?php
                                
                                    if ( !empty ( $title ) ) 
                                    {
                                    ?>
                                        <h2><?php echo $args['before_title'] . $title . $args['after_title']; ?></h2>
                                        <hr>

                                    <?php
                                    }

                                    if ( !empty( $subtitle ) )
                                        
                                     {
                                        ?>
                                        <h6><?php echo $subtitle; ?></h6>
                                    
                               <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php
                                    $post_in = array();

                                    if  (count($features) > 0 && is_array($features) )
                                    {

                                          $post_in[0] = $features['main'];
                                          
                                        foreach ( $features as $our_services )
                                        {
                                              
                                            if( isset( $our_services['page_ids'] ) && !empty( $our_services['page_ids'] ) )
                                            {
                                                
                                                   $post_in[] = $our_services['page_ids'];
                                                
                                            }
                                        }

                            
                                    }
                                    
                                    if( !empty( $post_in )) :
                                        $services_page_args = array(
                                                'post__in'         => $post_in,
                                                'orderby'             => 'post__in',
                                                'posts_per_page'      => count( $post_in ),
                                                'post_type'           => 'page',
                                                'no_found_rows'       => true,
                                                'post_status'         => 'publish'
                                        );
                                        $services_query = new WP_Query( $services_page_args );

                                        /*The Loop*/
                                        if ( $services_query->have_posts() ):
                                            $i = 1;
                                            while ( $services_query->have_posts() ):$services_query->the_post();
                                                            
                                                            $icon = get_post_meta( get_the_ID(), 'nexas_icon', true );
                                                            
                                                            $idvalue[] = get_the_ID();
                                                            
                                                            ?>

                                                            <div class="col-md-4">
                                                                <div class="section-4-box wow fadeIn"
                                                                     data-wow-delay=".<?php echo esc_attr($i); ?>s">
                                                                    <div class="section-4-box-icon-cont">
                                                                        <i class="fa <?php echo esc_attr($icon); ?> fa-3x"></i>
                                                                    </div>
                                                                    <div class="section-4-box-text-cont">
                                                                        <a href="<?php the_permalink();?>"><h5><?php the_title(); ?></h5></a>
                                                                        <p><?php  the_excerpt(); ?></p>
                                                                    </div>
                                                                </div>
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
        public function update($new_instance, $old_instance)
        {
            $instance              = $old_instance;
            $instance['main']      = absint($new_instance['main']);
            $instance['title']     = ( isset( $new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
            $instance['sub_title'] = ( isset( $new_instance['sub_title'])) ? sanitize_text_field($new_instance['sub_title']) : '';
            
            if (isset($new_instance['features']))
            {
                foreach($new_instance['features'] as $feature)
                {
                  
                  $feature['page_ids'] = absint($feature['page_ids']);
                }
                $instance['features']  = $new_instance['features'];
            }
            
            return $instance;

        }

        public function form($instance)
        {
            $instance   = wp_parse_args( (array ) $instance, $this->defaults() );
            $title      = esc_attr( $instance['title'] );
            $subtitle   = esc_attr( $instance['sub_title'] );
            $features   = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); 
            ?>
            <span class="pt-nexas-additional services">
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'nexas'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('sub_title') ); ?>">
                    <?php esc_html_e( 'Sub Title', 'nexas'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('sub_title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('sub_title')); ?>" value="<?php echo $subtitle; ?>">
            </p>
           <hr>
            <!--updated code-->
            <label><?php _e( 'Select Pages', 'nexas' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page and Remove. Please do not forget to add Icon and Excerpt  on selected pages.', 'nexas' ); ?></small>
               
             <?php
                 if  ( count( $features ) >=  1 && is_array( $features ) )
                 {
                
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
           
            if ( count( $features ) > 0 ) 
            {
                foreach( $features as $feature ) 
                {

                    if ( isset( $feature['page_ids'] ) ) 

                    { ?>
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
         <a class="pt-nexas-add button" data-id="nexas_service_widget" id="<?php echo $repeater_id; ?>"><?php _e('Add New Section', 'nexas'); ?></a> 
           
            <?php
        }
    }
}


add_action( 'widgets_init', 'nexas_service_widget' );

function nexas_service_widget() {
    
    register_widget( 'Nexas_Services_Widget' );
}
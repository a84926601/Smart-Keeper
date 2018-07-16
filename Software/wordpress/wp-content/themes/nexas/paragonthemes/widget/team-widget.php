<?php
/**
 * Class for adding Our Team Section Widget
 *
 * @package Paragon Themes
 * @subpackage Nexas
 * @since 1.0.0
 */
if ( ! class_exists( 'Nexas_Our_Team_Widget' ) ) {

	class Nexas_Our_Team_Widget extends WP_Widget {
		/*defaults values for fields*/

		 private function defaults()
        {
            /*defaults values for fields*/
            $defaults    = array(
                'title'      => '',
				'sub_title'  => '',
				'features'   =>'',
            );
            return $defaults;
        }
		
		function __construct() {
			parent::__construct(
			/*Base ID of your widget*/
				'nexas_our_team_widget',
				/*Widget name will appear in UI*/
				__( 'Nexas Team Section', 'nexas' ),
				/*Widget description*/
				array( 'description' => __( 'Nexas Our Team Section With Repeater.', 'nexas' ), )
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
		public function widget( $args, $instance ) {

		if (!empty( $instance ) ) 
		{
		
			$instance = wp_parse_args( (array ) $instance, $this->defaults ());
			
			$title         = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );

			$sub_title         = apply_filters( 'widget_title', ! empty( $instance['sub_title'] ) ? $instance['sub_title'] : '', $instance, $this->id_base );
			
            $features = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array();
          
            echo $args['before_widget'];
			?>

             <section id="section14" class="section-margine section14">
                 <?php if (isset($features) && !empty($features['main'])) : ?>    
                    <div class="container">
                    
                        <div class="row">
                    
                            <div class="col-md-12">
                    
                                <div class="section-title">
                    
                                    <?php
                    
                                    if ( !empty ( $title ) ) {
                                        
                                        ?>
                                        <h2><?php echo $args['before_title'] . $title . $args['after_title']; ?></h2>
                                        <hr>

                                    <?php }

                                    if ( !empty( $sub_title ) )
                                        
                                     {
                                        ?>
                                        <h6><?php echo $sub_title; ?></h6>
                                    
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                      <?php

						$post_in = array();

						if  (count($features) > 0 && is_array($features) ){

							  $post_in[0] = $features['main'];
							  
							foreach ( $features as $our_team ){
								  
								if( isset( $our_team['page_ids'] ) && !empty( $our_team['page_ids'] ) ){
									
									   $post_in[] = $our_team['page_ids'];
								    
								    }
							}

				
						}

						if( !empty( $post_in )) :
                            $our_team_page_args = array(
                                    'post__in'         => $post_in,
                                    'orderby'             => 'post__in',
                                    'posts_per_page'      => count( $post_in ),
                                    'post_type'           => 'page',
                                    'no_found_rows'       => true,
                                    'post_status'         => 'publish'
                            );
							$our_team_query = new WP_Query( $our_team_page_args );

							/*The Loop*/
							if ( $our_team_query->have_posts() ):
								$i = 0.1;
								while ( $our_team_query->have_posts() ):$our_team_query->the_post();
									?>
	                            <div class="col-md-4">
	                                <div class="section-14-box blog-box wow fadeInUp <?php if ( !has_post_thumbnail() ) {
	                                    echo "no-image";
	                                } ?> " data-wow-delay="<?php echo esc_attr($i); ?>s">

	                                    <?php
	                                    
	                                    if (has_post_thumbnail()) {
	                                    
	                                        $image_id = get_post_thumbnail_id();
	                                    
	                                        $image_url = wp_get_attachment_image_src($image_id, 'full', true);
	                                        ?>
	                                        <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive">
	                                    <?php }
	                                    ?>
	                                    <div class="entry-box">
	                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                                      
	                                        <p><?php the_excerpt(); ?></p>
	                                        <?php if(!empty($read_more)){ ?>
	                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">
	                                            <?php echo esc_html($read_more); ?>
	                                        </a>
	                                        <?php } ?>
	                                    </div>
	                                </div>
	                            </div>
	                             <?php
	                            $i++;
	                              
                             	endwhile;
							endif;
							wp_reset_postdata();
						  endif;
                            ?>
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
		public function update( $new_instance, $old_instance ) {
			
			$instance              = $old_instance;

			$instance['main']      = absint($new_instance['main']);
		
			$instance['title']     = sanitize_text_field( $new_instance['title'] );

			$instance['sub_title'] = sanitize_text_field( $new_instance['sub_title'] );

		
			if (isset($new_instance['features']))
		    {
		    	foreach($new_instance['features'] as $feature)
		    	{
			      
			      $feature['page_ids'] = absint($feature['page_ids']);
			    }

			    $instance['features'] = $new_instance['features'];
		    }
			
			return $instance;
		}

		/*Widget Backend*/
		public function form( $instance ) {

		    $instance      = wp_parse_args( (array ) $instance, $this->defaults() );
			$title         = esc_attr( $instance['title'] );
			$sub_title     = esc_attr( $instance['sub_title'] );
            $features      = ( ! empty( $instance['features'] ) ) ? $instance['features'] : array(); 
		
			?>
           <span class="pt-nexas-additional">
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'nexas' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
            </p>

             <p>
                <label for="<?php echo $this->get_field_id( 'sub_title' ); ?>"><?php _e( 'Sub Title', 'nexas' ); ?>:</label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'sub_title' ); ?>" name="<?php echo $this->get_field_name( 'sub_title' ); ?>" type="text" value="<?php echo $sub_title; ?>"/>
            </p>

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
		        $counter = 0;
		   
		    	if ( count( $features ) > 0 ) {
		        	foreach( $features as $feature ) {

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

				                <a class="pt-nexas-remove delete">
				                	<?php esc_html_e('Remove Section','nexas') ?>
				                </a>
			              </div>
			              <?php
			              $counter++;
		              }
		        }
		    }

		    ?>

		 </span>
		<a class="pt-nexas-add button" data-id="nexas_our_team_widget" id="<?php echo $repeater_id; ?>"><?php _e('Add New Section', 'nexas'); ?></a>   
           
			<?php
		}// end of form section
	}
}

add_action( 'widgets_init', 'nexas_our_team_widget' );

function nexas_our_team_widget()
{
    register_widget( 'Nexas_Our_Team_Widget' );

}
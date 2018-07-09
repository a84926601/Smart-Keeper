<?php
if (!class_exists( 'Nexas_Our_Work_Widget' ) ) {
    
    class Nexas_Our_Work_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'title'                      => esc_html__( 'Our Work', 'nexas' ),
                'nexas_portfolio_filter_all' => esc_html__( 'All', 'nexas' ),
                'cat_id'                     => '',
                'featured_image_size'        => 'full',
                'post_column'                => 3,
                'post_number'                => 15,
            );
            return $defaults;
        }


        public function __construct()
        {
            parent::__construct(
                'nexas-our-work-widget',
                
                esc_html__( 'Nexas Our Work Widget', 'nexas' ),
                
                array('description' => esc_html__( 'Nexas Work Section', 'nexas' ) )
            );
        }

        public function widget( $args, $instance )
        {

            $instance = wp_parse_args( (array) $instance, $this->defaults() );
           
            if ( !empty( $instance ) ) {
               $a1 = array(40,4,42);

               if($a1 == $instance['cat_id'] )
                {
                   $instance['cat_id'] = array(16,21,22);
                }     
                $post_number               = absint($instance['post_number']);
                $column_number             = absint($instance['post_column']);
                $featured_image            = esc_html($instance['featured_image_size']);
                $title                     = apply_filters('widget_title', !empty($instance['title']) ?esc_html($instance['title']) : '', $instance, $this->id_base);
                $nexas_ad_title            = esc_html($instance['nexas_portfolio_filter_all']);
                $nexas_selected_cat        = '';
                if (!empty($instance['cat_id'])) {
                    $nexas_selected_cat    = nexas_sanitize_multiple_category($instance['cat_id']);
                    if (is_array($nexas_selected_cat[0])) {
                      $nexas_selected_cat  = $nexas_selected_cat[0];
                    }
              }

                echo $args['before_widget'];
                ?>
                <section id="section-12">
                
                    <div class="container">
                
                        <?php
                        $sticky                   = get_option( 'sticky_posts' );
                        $nexas_cat_post_args      = array(
                            'posts_per_page'      => $post_number,
                            'no_found_rows'       => true,
                            'post_status'         => 'publish',
                            'ignore_sticky_posts' => true,
                            'post__not_in'        => $sticky,
                        );
                        if (-1 != $nexas_cat_post_args)
                        {

                            $nexas_cat_post_args['category__in'] = $nexas_selected_cat;
                        
                        }
          
                        $portfolio_filter_query = new WP_Query($nexas_cat_post_args);

                        ?>
                        <div class="row">
                        
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="text-center"><?php echo $title; ?></h2>
                                    <hr>
                                </div>
                        
                                <div class="portfolioFilter text-center">
                        
                                    <?php
                        
                                    if (!empty( $nexas_ad_title ) ) {
                        
                                        echo '<a href="#" data-filter="*" class="current">' . $nexas_ad_title . '</a>';
                                    }

                                    if (!empty( $nexas_selected_cat ) && is_array( $nexas_selected_cat ) ) 
                                    {
                                        foreach ( $nexas_selected_cat as $nexas_selected_single_cat ) 
                                        {

                                            echo ' <a href="#" data-filter=".' . esc_attr( $nexas_selected_single_cat ) . '">' . esc_html( get_cat_name($nexas_selected_single_cat ) ) . '</a>';
                                        }
                                    }

                                    ?>
                                </div>
                        
                                <div class="portfolioContainer">
                        
                                    <?php
                        
                                    if ($portfolio_filter_query->have_posts()):
                        
                                        while ($portfolio_filter_query->have_posts()):$portfolio_filter_query->the_post();

                                            if ( 2 == $column_number ) 
                                            
                                            {
                                                $nexas_column = "col-md-6";
                                            }
                                            
                                             elseif ( 3 == $column_number )
                                            
                                            {
                                                $nexas_column = "col-md-4";
                                            } 

                                            elseif( 4 == $column_number )
                                             
                                             {
                                             
                                                $nexas_column = 'col-md-3';
                                             }
                                            
                                            else

                                            {
                                            
                                              $nexas_column = 'col-md-12';
                                            
                                            }

                                            $categories = get_the_category( get_the_ID() );
                                            
                                            if ( !empty ( $categories) ) {
                                            
                                                foreach ( $categories as $category ) 
                                                {
                                            
                                                    $nexas_column .= ' ' . $category->term_id;
                                            
                                                }
                                            }
                                            if ( has_post_thumbnail() ) 
                                            {
                                            
                                                $image_id   = get_post_thumbnail_id();
                                            
                                                $image_url  = wp_get_attachment_image_src($image_id, $featured_image, true);
                                            
                                                $image_path = $image_url[0];
                                            
                                                ?>
                                            
                                                <div class="<?php echo esc_attr($nexas_column); ?> col-sm-12 col-xs-12  text-left">
                                                    <div class="filter-box">
                                                        <div class="image-box">
                                                            <a class="magnific-popup" href="<?php echo esc_url($image_url[0]); ?>">
                                                                <img src="<?php echo esc_url($image_url[0]); ?>" class="img-responsive wow zoomIn" alt="image">
                                                            </a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                        <div class="lower-box">
                                                            <div class="lower-box-inner">
                                                                <a class="magnific-popup" href="<?php echo esc_url($image_url[0]); ?>">
                                                                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                </a>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                                </a>
                                                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                                <p><?php the_excerpt(); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        endwhile;
                                    endif;
                                    wp_reset_postdata();
                                    ?>
                                </div><!--portfolioContainer-->
                                </div><!--col-md-12-->
                            </div><!--.row-->
                        </div><!--.container-->
                </section><!--section-->
                <?php
                echo $args['after_widget'];
            }
        }

        public function update( $new_instance, $old_instance )
        {
            $instance                               = $old_instance;
            $instance['cat_id']                     = (isset($new_instance['cat_id'])) ? nexas_sanitize_multiple_category( $new_instance['cat_id'] ) : array('');
            $instance['nexas_portfolio_filter_all'] = sanitize_text_field($new_instance['nexas_portfolio_filter_all']);
            $instance['title']                      = sanitize_text_field( $new_instance['title'] );
            $instance['post_number']                = absint( $new_instance['post_number'] );
            $instance['post_column']                = absint( $new_instance['post_column']);
            $instance['featured_image_size']        = sanitize_text_field($new_instance['featured_image_size']);

            return $instance;
        }

        public function form( $instance )

        {

            $instance                   = wp_parse_args( (array )$instance, $this->defaults() );
            $post_number                = absint($instance['post_number']);
            $column_number              = absint($instance['post_column']);
            $featured_image_size        = esc_attr($instance['featured_image_size']);
            $title                      = esc_attr($instance['title']);
            $nexas_ad_title             = esc_attr($instance['nexas_portfolio_filter_all']);
            $nexas_selected_cat         = '';
            $a1 = array(40,4,42);
          
            if($a1 == $instance['cat_id'] )
             
              {
                $instance['cat_id'] = array(16,21,22);
              }
             
            if (!empty($instance['cat_id'])) 
            {
                $nexas_selected_cat     = $instance['cat_id'];
                
                if (is_array($nexas_selected_cat[0])) 

                {
                    $nexas_selected_cat = $nexas_selected_cat[0];
                }
            }
            ?>
            <p>

                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_html_e('Title:', 'nexas'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo $title; ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('nexas_portfolio_filter_all')); ?>"><?php esc_html_e('Our Work Filter All Text', 'nexas'); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('nexas_portfolio_filter_all')); ?>" name="<?php echo esc_attr($this->get_field_name('nexas_portfolio_filter_all')); ?>" type="text" value="<?php echo $nexas_ad_title; ?>"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>"><strong><?php esc_html_e('Select Category', 'nexas'); ?></strong></label>
                <select class="widefat" name="<?php echo $this->get_field_name('cat_id'); ?>[]" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>" multiple="multiple">
                    <?php
                    $option        = '';
                    
                    $categories    = get_categories();
                    
                    if ( $categories ) {
                    
                        foreach ($categories as $category) {
                    
                            $result = in_array($category->term_id, $nexas_selected_cat) ? 'selected=selected' : '';
                    
                            $option .= '<option value="' . esc_attr($category->term_id) . '"' . esc_attr($result) . '>';
                    
                            $option .= esc_html($category->cat_name);
                    
                            $option .= esc_html(' (' . $category->category_count . ')');
                    
                            $option .= '</option>';
                        }
                    }
                    echo $option;
                    ?>
                </select>
            </p>
            <hr>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_number')); ?>"><strong><?php esc_html_e('Number of Posts:', 'nexas'); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_number')); ?>" name="<?php echo esc_attr($this->get_field_name('post_number')); ?>" type="number" value="<?php echo $post_number; ?>" min="1"/>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('post_column')); ?>"><strong><?php esc_html_e('Number of Columns:', 'nexas'); ?></strong></label>
                <?php
                $this->dropdown_post_columns(
                        array(
                        'id'       => esc_attr($this->get_field_id('post_column')),
                        'name'     => esc_attr($this->get_field_name('post_column')),
                        'selected' => $column_number
                        )
                );
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('featured_image_size')); ?>"><strong><?php esc_html_e('Select Image Size:', 'nexas'); ?></strong></label>
                <?php
                $this->dropdown_image_sizes(array(
                        'id'       => esc_attr($this->get_field_id('featured_image_size')),
                        'name'     => esc_attr($this->get_field_name('featured_image_size')),
                        'selected' => $featured_image_size,
                    )
                );
                ?>
            </p>
            <?php

        }


        function dropdown_post_columns( $args )
        {
            $defaults      = array(
                'id'       => '',
                'name'     => '',
                'selected' => 0,
            );

            $r = wp_parse_args($args, $defaults);
            $output = '';

            $choices = array(
                2 => esc_html__( '2', 'nexas' ),
                3 => esc_html__( '3', 'nexas' ),
                4 => esc_html__( '4', 'nexas' ),
            );

            if ( !empty( $choices ) ) {

                $output = "<select name='" . esc_attr($r['name']) . "' id='" . esc_attr($r['id']) . "'>\n";
               
                foreach ($choices as $key => $choice) {
                    $output .= '<option value="' . esc_attr($key) . '" ';
                    $output .= selected($r['selected'], $key, false);
                    $output .= '>' . esc_html($choice) . '</option>\n';
                }
               
                $output .= "</select>\n";
            
            }

            echo $output;
        }

        function dropdown_image_sizes($args)
        {
            $defaults = array(
                'id'       => '',
                'class'    => 'widefat',
                'name'     => '',
                'selected' => 0,
            );

            $r = wp_parse_args($args, $defaults);
            $output = '';

            $choices = array(
                'thumbnail' => esc_html__('Thumbnail', 'nexas'),
                'medium'    => esc_html__('Medium', 'nexas'),
                'large'     => esc_html__('Large', 'nexas'),
                'full'      => esc_html__('Full', 'nexas'),
            );

            if (!empty($choices)) {

                $output = "<select name='" . esc_attr($r['name']) . "' id='" . esc_attr($r['id']) . "' class='" . esc_attr($r['class']) . "'>\n";
                
                foreach ($choices as $key => $choice) 
                {
                    $output .= '<option value="' . esc_attr($key) . '" ';
                    $output .= selected($r['selected'], $key, false);
                    $output .= '>' . esc_html($choice) . '</option>\n';
                }

                $output .= "</select>\n";
            }

            echo $output;
        }

    }
}

add_action( 'widgets_init', 'nexas_our_work_widget' );
function nexas_our_work_widget()
{
    register_widget( 'Nexas_Our_Work_Widget' );

}
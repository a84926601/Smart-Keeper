<?php
if (!class_exists('Nexas_Recent_Post_Widget')) {
 
    class Nexas_Recent_Post_Widget extends WP_Widget
 
    {

        private function defaults()
 
        {

            $defaults       = array(
                'cat_id'    => -1,
                'title'     => esc_html__('Recent Posts','nexas'),
                'sub_title' => esc_html__('Read Our Recent Updates','nexas'),
                'read_more' => esc_html__('Read More','nexas'),
            );

            return $defaults;
        }

     public function __construct()
        {
            parent::__construct(
                'nexas-recent-post-widget',
                esc_html__( 'Nexas Recent Post Widget', 'nexas' ),
                array( 'description' => esc_html__( 'Nexas Recent Post Section', 'nexas' ) )
            );
        }

        public function widget( $args, $instance )
        {

            if ( !empty( $instance ) ) {
                
                $instance = wp_parse_args( (array ) $instance, $this->defaults() );
                
                echo $args['before_widget'];
                $catid        = absint( $instance['cat_id'] );
                $title        = apply_filters('widget_title', !empty($instance['title']) ? esc_html( $instance['title']): '', $instance, $this->id_base);
                $subtitle     =  esc_html( $instance['sub_title'] );
                $read_more    =  esc_html( $instance['read_more'] );

                ?>
                <section id="section14" class="section-margine section14">
                    
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

                                    if ( !empty( $subtitle ) )
                                        
                                     {
                                        ?>
                                        <h6><?php echo $subtitle; ?></h6>
                                    
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php
                            $i = 0;
                            $sticky = get_option( 'sticky_posts' );
                            if ($catid != -1) {
                                $home_recent_post_section = array(
                                    'ignore_sticky_posts' => true,
                                    'post__not_in'        => $sticky,
                                    'cat'                 => $catid,
                                    'posts_per_page'      => 3,
                                    'order'               => 'DESC'
                                );
                            } else {
                                $home_recent_post_section = array(
                                    'ignore_sticky_posts' => true,
                                    'post__not_in'        => $sticky,
                                    'post_type'           => 'post',
                                    'posts_per_page'      => 3,
                                    'order'               => 'DESC'
                                );
                            }

                            $home_recent_post_section_query = new WP_Query($home_recent_post_section);

                            if ( $home_recent_post_section_query->have_posts() ) {
                                
                                while ($home_recent_post_section_query->have_posts()) {
                                    
                                    $home_recent_post_section_query->the_post();
                                    
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
                                                <div class="date">
                                                    <span><?php echo esc_html( get_the_date('M') ); ?></span>
                                                    <span><?php echo esc_html( get_the_date('d') ); ?></span>
                                                    <span><?php echo esc_html( get_the_date('Y') ); ?></span>
                                                </div>
                                                <div class="text-left author-post">
                                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?> ">
                                                        <?php the_author(); ?>
                                                    </a>
                                                </div>
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
                                }
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </section>
                <?php
                echo $args['after_widget'];
            }
        }

        public function update($new_instance, $old_instance)
        {
            $instance              = $old_instance;
            $instance['cat_id']    = (isset( $new_instance['cat_id'] ) ) ? absint($new_instance['cat_id']) : '';
            $instance['title']     = sanitize_text_field( $new_instance['title'] );
            $instance['sub_title'] = sanitize_text_field( $new_instance['sub_title'] );
            $instance['read_more'] = sanitize_text_field( $new_instance['read_more'] );

            return $instance;

        }

        public function form( $instance )
        {
            $instance  = wp_parse_args( (array ) $instance, $this->defaults() );
            $catid     = absint( $instance['cat_id'] );
            $title     = esc_attr( $instance['title'] );
            $subtitle  = esc_attr( $instance['sub_title'] );
            $read_more = esc_attr( $instance['read_more'] );

            ?>

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

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('cat_id') ); ?>">
                    <?php esc_html_e('Select Category', 'nexas'); ?>
                </label><br/>
                <?php
                $nexas_con_dropown_cat = array(
                    'show_option_none' => esc_html__('From Recent Posts', 'nexas'),
                    'orderby'          => 'name',
                    'order'            => 'asc',
                    'show_count'       => 1,
                    'hide_empty'       => 1,
                    'echo'             => 1,
                    'selected'         => $catid,
                    'hierarchical'     => 1,
                    'name'             => esc_attr( $this->get_field_name('cat_id') ),
                    'id'               => esc_attr( $this->get_field_name('cat_id') ),
                    'class'            => 'widefat',
                    'taxonomy'         => 'category',
                    'hide_if_empty'    => false,
                );

                wp_dropdown_categories( $nexas_con_dropown_cat );
                
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('read_more') ); ?>">
                    <?php esc_html_e( 'Read More Text', 'nexas'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('read_more')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('read_more')); ?>" value="<?php echo $read_more; ?>">
            </p>

            <?php
        }
    }
}

add_action('widgets_init', 'nexas_recent_post_widget');

function nexas_recent_post_widget()

{
    register_widget('Nexas_Recent_Post_Widget');

}
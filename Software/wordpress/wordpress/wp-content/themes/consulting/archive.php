<?php
/**
 * The template for displaying Archive pages.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php if( have_posts() ): ?>

				<div id="container">

				</div><div class="clearboth"></div>

				<?php the_posts_pagination( array(
					'mid_size' => 2,
					'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'consulting' ),
					'next_text' => __( '<i class="fa fa-angle-right"></i>', 'consulting' ),
				) ); ?>

			<?php else: ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>		

			<?php endif; ?>

<?php get_footer() ?>
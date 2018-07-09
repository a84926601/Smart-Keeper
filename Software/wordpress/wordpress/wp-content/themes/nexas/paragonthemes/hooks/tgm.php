<?php
/**
 * Recommended plugins
 *
 * @package Nexas
 */
if ( ! function_exists( 'nexas_recommended_plugins' ) ) :
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.0
	 */
	function nexas_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'nexas' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),

			array(
				'name'     => esc_html__( 'Contact Us', 'nexas' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),

			array(
				'name'     => esc_html__( 'WooCommerce', 'nexas' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
		   
		);
		tgmpa( $plugins );
	}
endif;
add_action( 'tgmpa_register', 'nexas_recommended_plugins' );

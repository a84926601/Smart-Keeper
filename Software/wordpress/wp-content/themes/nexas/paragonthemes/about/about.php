<?php
/**
 * About setup
 *
 * @package Nexas
 */

if ( ! function_exists( 'nexas_about_setup' ) ) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function nexas_about_setup() {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'one-click-demo-import/one-click-demo-import.php' ) ):

		    $url =  admin_url( 'themes.php?page=pt-one-click-demo-import' );

		else:

		     $url = admin_url();

		endif;

		$config = array(

			// Welcome content.
			'welcome_content' => sprintf( esc_html__( '%1$s is now installed and ready to use. Thank you for choosing Nexas for your Website. Please follow theme documentation properly to know how to use Nexas.', 'nexas' ), 'Nexas' ),

			// Tabs.
			'tabs' => array(
				'getting-started' => esc_html__( 'Getting Started', 'nexas' ),
				),
			// Quick links.
			'quick_links' => array(
                'theme_url' => array(
                    'text' => esc_html__( 'Theme Details', 'nexas' ),
                    'url'  => 'https://paragonthemes.com/themes/nexas/',
                    'button' => 'primary',
                ),
				'translation_url' => array(
					'text'   => esc_html__( 'Translate on your own Language', 'nexas' ),
					'url'    => 'https://translate.wordpress.org/projects/wp-themes/nexas/',
					'button' => 'primary',
				),
            ),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__( 'Theme Documentation', 'nexas' ),
					'icon'        => 'dashicons dashicons-format-aside',
					'description' => esc_html__( 'Please check our full documentation for detailed information on how to setup and customize the theme.', 'nexas' ),
					'button_text' => esc_html__( 'View Documentation', 'nexas' ),
					'button_url'  => 'http://doc.paragonthemes.com/nexas/',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
				'two' => array(
					'title'       => esc_html__( 'Static Front Page', 'nexas' ),
					'icon'        => 'dashicons dashicons-admin-generic',
					'description' => esc_html__( 'To achieve custom home page other than blog listing, you need to create and set static front page.', 'nexas' ),
					'button_text' => esc_html__( 'Static Front Page', 'nexas' ),
					'button_url'  => admin_url( 'customize.php?autofocus[section]=static_front_page' ),
					'button_type' => 'primary',
					),
				'three' => array(
					'title'       => esc_html__( 'Theme Options', 'nexas' ),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__( 'Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'nexas' ),
					'button_text' => esc_html__( 'Customize', 'nexas' ),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
					),
				'four' => array(
					'title'       => esc_html__( 'Demo Content', 'nexas' ),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf( esc_html__( 'To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'nexas' ), esc_html__( 'One Click Demo Import', 'nexas' ) ),
					'button_text' => esc_html__( 'Demo Import', 'nexas' ),
					'button_url'  => $url,
					'button_type' => 'primary',
					),
				'five' => array(
					'title'       => esc_html__( 'Theme Preview', 'nexas' ),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__( 'You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized.', 'nexas' ),
					'button_text' => esc_html__( 'View Demo', 'nexas' ),
					'button_url'  => 'http://demo.paragonthemes.com/nexas',
					'button_type' => 'primary',
					'is_new_tab'  => true,
					),
                'six' => array(
                    'title'       => esc_html__( 'Contact Support', 'nexas' ),
                    'icon'        => 'dashicons dashicons-sos',
                    'description' => esc_html__( 'Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'nexas' ),
                    'button_text' => esc_html__( 'Contact Support', 'nexas' ),
                    'button_url'  => 'https://paragonthemes.com/contact-us/',
					'button_type' => 'primary',
                    'is_new_tab'  => true,
                ),
				),

			// Useful plugins.
			'useful_plugins'  => array(
				'description' => esc_html__( 'Theme supports some helpful WordPress plugins to enhance your site.Please click Manage Plugins button below to enable those plugins which you need in your site,if those plugin are not Install.', 'nexas' ),
				),

			);

		Nexas_About::init( $config );
	}

endif;

add_action( 'after_setup_theme', 'nexas_about_setup' );

<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
get_header();
 ?>

    <section id="inner-title" class="inner-title" >
        
        <div class="container">
        
            <div class="row">
        
                <div class="col-md-8">
                    
                    <h2><?php esc_html_e('404 Not Found', 'nexas'); ?></h2>

                </div>
                ?>
            </div>
        </div>
    </section>

    <section id="section19" class="section19">
        <div class="container">
            <div class="row">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <section class="error-404 not-found">
                            <header class="page-header">
                                <h1 class="page-title"><?php esc_html_e('404', 'nexas'); ?></h1>
                            </header><!-- .page-header -->

                            <div class="page-content text-center">
                                <p><?php esc_html_e('It looks like nothing was found at this location.', 'nexas'); ?></p>

                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>
        </div>
    </section>

<?php get_footer();

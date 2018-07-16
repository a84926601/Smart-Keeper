<?php
/**
 * Custom Search Form
 *
 * @package Paragon Themes
 * @subpackage Nexas
 */
global  $nexas_placeholder_option;
?>
<div class="search-block">
    <form action="<?php echo esc_url( home_url() )?>" class="searchform search-form" id="searchform" method="get" role="search">
        <div>
            <label for="menu-search" class="screen-reader-text"></label>
            <?php
            $nexas_placeholder_text     = '';
            $nexas_placeholder_option   = nexas_get_option( 'nexas_post_search_placeholder_option');
            if ( !empty( $nexas_placeholder_option) ):
                $nexas_placeholder_text = 'placeholder="'.esc_attr ( $nexas_placeholder_option ). '"';
            endif; ?>
            <input type="text" <?php echo $nexas_placeholder_text ;?> class="blog-search-field" id="menu-search" name="s" value="<?php echo get_search_query();?>">
            <button class="searchsubmit fa fa-search" type="submit" id="searchsubmit"></button>
        </div>
    </form>
</div>
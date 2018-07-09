<?php
/**
 * Class for adding font awesome icons
 *
 * @package Paragon Themes
 * @subpackage Nexas
 * @since 1.0.0
 */
if( !class_exists( 'Nexas_Font_Awesome_Class_Metabox') ){
    class Nexas_Font_Awesome_Class_Metabox {

        public function __construct()
        {

            add_action( 'add_meta_boxes', array( $this, 'nexas_icon_metabox') );

            add_action( 'save_post', array( $this, 'nexas_save_icon_value') );
        }


        public function nexas_icon_metabox()
        {

            add_meta_box(
                    'nexas_icon',
                    esc_html__('Font Awesome Class For Features', 'nexas'),
                    array(
                            $this, 'nexas_generate_icon'),
                    'page',
                    'side',
                    'low'
            );
        }

        public function nexas_generate_icon($post)
        {
            $values = get_post_meta( $post->ID, 'nexas_icon', true );
            wp_nonce_field( basename(__FILE__), 'nexas_fontawesome_fields_nonce');
            ?>
            <input type="text" name="icon" value="<?php echo esc_attr($values) ?>" />
            <br/>
            <small>
                <?php
                esc_html_e( 'Font Awesome Icon Used in Post', 'nexas' );
                printf( __( '%1$sRefer here%2$s for icon class. For example: %3$sfa-desktop%4$s', 'nexas' ), '<br /><a href="'.esc_url( 'https://fontawesome.com/v4.7.0/icons/' ).'" target="_blank">','</a>',"<code>","</code>" );
                ?>
            </small>
            <?php
        }

        public function nexas_save_icon_value($post_id)
        {

            /*
                * A Guide to Writing Secure Themes – Part 4: Securing Post Meta
                *https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/
                * */
            if (
                !isset($_POST['nexas_fontawesome_fields_nonce']) ||
                !wp_verify_nonce($_POST['nexas_fontawesome_fields_nonce'], basename(__FILE__)) || /*Protecting against unwanted requests*/
                (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) || /*Dealing with autosaves*/
                !current_user_can('edit_post', $post_id)/*Verifying access rights*/
            ) {
                return;
            }

            //Execute this saving function
            if (isset($_POST['icon']) && !empty($_POST['icon'])) {
                $fontawesomeclass = sanitize_text_field( $_POST['icon'] );
                update_post_meta($post_id, 'nexas_icon', $fontawesomeclass);
            }
        }
    }
}
$productsMetabox = new Nexas_Font_Awesome_Class_Metabox;
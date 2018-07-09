<?php
/**
 * Slider Section
 *
 */
$wp_customize->add_section(
    'nexas_slider_section',
    array(
        'title'     => esc_html__('Slider Setting Option', 'nexas'),
        'panel'     => 'nexas_theme_options',
        'priority'  => 4,
    )
);
/**
 * Homepage Slider Repeater Section
 *
 */
$slider_pages = array();
$slider_pages_obj = get_pages();
$slider_pages[''] = esc_html__('Select Page For Slider','nexas');
foreach ($slider_pages_obj as $page) {
    $slider_pages[$page->ID] = $page->post_title;
}
$wp_customize->add_setting( 
    'nexas_slider_option', 
    array(
    'sanitize_callback' => 'nexas_sanitize_slider_data',
    'default'           => $default['nexas_slider_option']
) );
$wp_customize->add_control(
    new Nexas_Repeater_Control(
        $wp_customize,
        'nexas_slider_option',
        array(
            'label'                      => __('Slider Page Selection Section','nexas'),
            'description'                => __('Select Page For Slider Having Featured Image. You can drag to reposition the slider items','nexas'),
            'section'                    => 'nexas_slider_section',
            'settings'                   => 'nexas_slider_option',
            'repeater_main_label'        => __('Select Page For Slider ','nexas'),
            'repeater_add_control_field' => __('Add New Slide','nexas')
        ),
        array(
            'selectpage'                 => array(
            'type'                       => 'select',
            'label'                      => __( 'Select Page For Slide', 'nexas' ),
            'options'                    => $slider_pages
            ),
            'button_text'                => array(
            'type'                       => 'text',
            'label'                      => __( 'Button Text', 'nexas' ),
            ),
            'button_link'                => array(
            'type'                       => 'url',
            'label'                      => __( 'Button Link', 'nexas' ),
            ),
        )
    )
);

/**
 * Homepage Slider Section Show
 *
 */
$wp_customize->add_setting(
    'nexas_homepage_slider_option',
    array(
        'default'           => $default['nexas_homepage_slider_option'],
        'sanitize_callback' => 'nexas_sanitize_select',
    )
);
$hide_show_option = nexas_slider_option();
$wp_customize->add_control(
    'nexas_homepage_slider_option',
    array(
        'type'        => 'radio',
        'label'       => esc_html__('Slider Option', 'nexas'),
        'description' => esc_html__('Show/hide option for homepage Slider Section.', 'nexas'),
        'section'     => 'nexas_slider_section',
        'choices'     => $hide_show_option,
        'priority'    => 7
    )
);
	
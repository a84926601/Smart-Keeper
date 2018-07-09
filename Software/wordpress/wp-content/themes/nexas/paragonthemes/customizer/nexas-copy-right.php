<?php
/**
 * Copyright Info Section
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'nexas_copyright_info_section',
    array(
        'priority'        => 100,
        'capability'      => 'edit_theme_options',
        'theme_supports'  => '',
        'title'           => esc_html__('Footer Option', 'nexas'),
    )
);

/**
 * Field for Copyright
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'nexas_copyright',
    array(
        'default'           => $default['nexas_copyright'],
        'sanitize_callback' => 'wp_kses_post',
    )
);
$wp_customize->add_control(
    'nexas_copyright',
    array(
        'type'     => 'text',
        'label'    => esc_html__('Copyright', 'nexas'),
        'section'  => 'nexas_copyright_info_section',
        'priority' => 8
    )
);


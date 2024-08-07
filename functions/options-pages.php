<?php

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'site-settings',
        'page_title' => 'Site Settings',
        'active' => true,
        'menu_title' => 'Site Settings',
        'capability' => 'edit_posts',
        'parent_slug' => '',
        'position' => 60,
        'icon_url' => 'dashicons-admin-site',
        'redirect' => true,
        'post_id' => 'site_style',
        'autoload' => false,
        'update_button' => 'Update Style',
        'updated_message' => 'Style Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'header',
        'page_title' => 'Header',
        'active' => true,
        'menu_title' => 'Header',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 61,
        'icon_url' => 'dashicons-art',
        'redirect' => true,
        'post_id' => 'header',
        'autoload' => false,
        'update_button' => 'Update Header',
        'updated_message' => 'Header Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'layout',
        'page_title' => 'Layout',
        'active' => true,
        'menu_title' => 'Layout',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 62,
        'icon_url' => 'dashicons-art',
        'redirect' => true,
        'post_id' => 'layout',
        'autoload' => false,
        'update_button' => 'Update Layout',
        'updated_message' => 'Layout Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'buttons',
        'page_title' => 'Buttons',
        'active' => true,
        'menu_title' => 'Buttons',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 63,
        'icon_url' => 'dashicons-art',
        'redirect' => true,
        'post_id' => 'buttons',
        'autoload' => false,
        'update_button' => 'Update Buttons',
        'updated_message' => 'Buttons Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'integrations',
        'page_title' => 'Integrations',
        'active' => true,
        'menu_title' => 'Integrations',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 62,
        'icon_url' => 'dashicons-art',
        'redirect' => true,
        'post_id' => 'integrations',
        'autoload' => false,
        'update_button' => 'Update',
        'updated_message' => 'Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Element Settings',
        'menu_slug' => 'elements',
        'menu_title' => 'Element Settings',
        'active' => true,
        'capability' => 'edit_posts',
        'parent_slug' => '',
        'position' => 61,
        'menu_icon' => array(
            'type' => 'dashicons',
            'value' => 'dashicons-images-alt',
        ),
        'icon_url' => 'dashicons-images-alt',
        'redirect' => true,
        'post_id' => 'site_settings',
        'autoload' => false,
        'update_button' => 'Update Elements',
        'updated_message' => 'Elements Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'dividers',
        'page_title' => 'Dividers',
        'active' => true,
        'menu_title' => 'Dividers',
        'capability' => 'edit_posts',
        'parent_slug' => 'elements',
        'position' => '',
        'icon_url' => '',
        'redirect' => false,
        'post_id' => 'dividers',
        'autoload' => false,
        'update_button' => 'Update',
        'updated_message' => 'Dividers Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Forms',
        'menu_slug' => 'forms',
        'active' => true,
        'menu_title' => 'Forms',
        'capability' => 'edit_posts',
        'parent_slug' => 'elements',
        'position' => '',
        'icon_url' => '',
        'redirect' => false,
        'post_id' => 'forms',
        'autoload' => false,
        'update_button' => 'Update',
        'updated_message' => 'Forms Updated',
    ));
}
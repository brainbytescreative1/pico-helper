<?php

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'site-style',
        'page_title' => 'Site Style',
        'active' => true,
        'menu_title' => 'Site Style',
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
        'parent_slug' => 'site-style',
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
        'parent_slug' => 'site-style',
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
        'parent_slug' => 'site-style',
        'position' => 63,
        'icon_url' => 'dashicons-art',
        'redirect' => true,
        'post_id' => 'buttons',
        'autoload' => false,
        'update_button' => 'Update Buttons',
        'updated_message' => 'Buttons Updated',
    ));
}

/*
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
        'post_id' => 'site_settings',
        'autoload' => false,
        'update_button' => 'Update Settings',
        'updated_message' => 'Settings Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'style',
        'page_title' => 'Style',
        'active' => true,
        'menu_title' => 'Style',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 60,
        'icon_url' => 'dashicons-admin-appearance',
        'redirect' => true,
        'post_id' => 'style',
        'autoload' => false,
        'update_button' => 'Update Style',
        'updated_message' => 'Style Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'theme-css',
        'page_title' => 'Theme CSS',
        'active' => true,
        'menu_title' => 'Theme CSS',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 61,
        'icon_url' => 'dashicons-art',
        'redirect' => true,
        'post_id' => 'css',
        'autoload' => false,
        'update_button' => 'Update Theme CSS',
        'updated_message' => 'Theme CSS Updated',
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
        'position' => 62,
        'icon_url' => 'dashicons-heading',
        'redirect' => false,
        'post_id' => 'header',
        'autoload' => false,
        'update_button' => 'Update Header',
        'updated_message' => 'Header Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'social',
        'page_title' => 'Social',
        'active' => true,
        'menu_title' => 'Social',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 63,
        'icon_url' => 'dashicons-networking',
        'redirect' => true,
        'post_id' => 'social',
        'autoload' => false,
        'update_button' => 'Update Social',
        'updated_message' => 'Social Updated',
    ));
}

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'custom-code',
        'page_title' => 'Custom Code',
        'active' => true,
        'menu_title' => 'Custom Code',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 64,
        'icon_url' => 'dashicons-media-code',
        'redirect' => true,
        'post_id' => 'code',
        'autoload' => false,
        'update_button' => 'Update Custom Code',
        'updated_message' => 'Custom Code Updated',
        'content_width' => 'container',
        'header_background_image' => 'inherit',
        'custom_js' => '',
    ));
}
    */

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
/*
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Tabs',
        'menu_slug' => 'tabs',
        'active' => true,
        'menu_title' => 'Tabs',
        'capability' => 'edit_posts',
        'parent_slug' => 'elements',
        'position' => '',
        'icon_url' => '',
        'redirect' => false,
        'post_id' => 'tabs',
        'autoload' => false,
        'update_button' => 'Update',
        'updated_message' => 'Tabs Updated',
    ));
}
*/

/*
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'footer',
        'page_title' => 'Footer',
        'active' => true,
        'menu_title' => 'Footer',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 63,
        'icon_url' => 'dashicons-slides',
        'redirect' => true,
        'post_id' => 'footer',
        'autoload' => false,
        'update_button' => 'Update Footer',
        'updated_message' => 'Options Updated',
        'content_width' => 'container',
        'header_background_image' => 'inherit',
    ));
}
*/



/*
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'menu_slug' => 'post-settings',
        'page_title' => 'Post Settings',
        'active' => true,
        'menu_title' => 'Post Settings',
        'capability' => 'edit_posts',
        'parent_slug' => 'site-settings',
        'position' => 63,
        'icon_url' => 'dashicons-admin-page',
        'redirect' => true,
        'post_id' => 'post-settings',
        'autoload' => false,
        'update_button' => 'Update Post Settings',
        'updated_message' => 'Post Settings Updated',
    ));
}
*/


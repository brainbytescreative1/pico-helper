<?php

/*
function sample_shortcode() {
	ob_start();
    return ob_get_clean();
}
add_shortcode( 'sample', 'sample_shortcode' );
*/

// site name
function bbc_site_name_shortcode() {
    return get_bloginfo('name');
}
add_shortcode( 'bbc_site_name', 'bbc_site_name_shortcode' );

// get year
function bbc_get_year_shortcode() {
    return date('Y');
}
add_shortcode( 'year', 'bbc_get_year_shortcode' );

// global email
function bbc_global_email_shortcode($atts) {

    $default = array(
        'link' => false,
    );

    $link = shortcode_atts($default, $atts);

    $global_email = get_field('global_email', 'integrations');
    if ( $global_email ) {
        if ( $link['link'] === 'true' ) {
            return '<a href="mailto:' . $global_email . '">' . $global_email . '</a>';
        } else {
            return $global_email;
        }
    }

}
add_shortcode( 'bbc_global_email', 'bbc_global_email_shortcode' );

// global phone
function bbc_global_phone_shortcode($atts) {

    $default = array(
        'link' => false,
    );

    $link = shortcode_atts($default, $atts);

    $global_phone = get_field('global_phone', 'integrations');
    if ( $global_phone ) {
        if ( $link['link'] === 'true' ) {
            $global_phone_clean = preg_replace('/[^a-z\d]/i', '', $global_phone);
            return '<a href="tel:+1' . $global_phone_clean . '">' . $global_phone . '</a>';
        } else {
            return $global_phone;
        }
    }

}
add_shortcode( 'bbc_global_phone', 'bbc_global_phone_shortcode' );
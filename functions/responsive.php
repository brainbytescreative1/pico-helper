<?php

function get_responsive_bbc($field = false, $sub = true) {

    if ( $field ) {
        if ( $sub = false ) {
            $field = get_field($field);
        } else {
            $field = get_sub_field($field);
        }
    }   

    // initialize
    $classes = [];

    if ( $field ) {
        if ( $field['hide_desktop'] ) {
            $classes[] = 'desktop-hide';
        }
        if ( $field['hide_tablet'] ) {
            $classes[] = 'tablet-hide';
        }
        if ( $field['hide_mobile'] ) {
            $classes[] = 'mobile-hide';
        }
    }

    return trim(implode(' ', $classes));

}
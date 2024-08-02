<?php

function get_borders_bbc($field) {

    $classes = [];

    if ( $field ) {

        if ( $field['border_radius_all'] !== 'default' ) {
            $classes[] = 'rounded-' . $field['border_radius_all'];
            $classes[] = 'overflow-hidden';
        }
        
        if ( $field['border-top-left-radius'] !== 'default' ) {
            $classes[] = 'border-top-left-radius-' . $field['border-top-left-radius'];
            $classes[] = 'overflow-hidden';
        }
        if ( $field['border-top-right-radius'] !== 'default' ) {
            $classes[] = 'border-top-right-radius-' . $field['border-top-right-radius'];
            $classes[] = 'overflow-hidden';
        }
        if ( $field['border-bottom-left-radius'] !== 'default' ) {
            $classes[] = 'border-bottom-left-radius-' . $field['border-bottom-left-radius'];
            $classes[] = 'overflow-hidden';
        }
        if ( $field['border-bottom-right-radius'] !== 'default' ) {
            $classes[] = 'border-bottom-right-radius-' . $field['border-bottom-right-radius'];
            $classes[] = 'overflow-hidden';
        }

        $classes = array_unique($classes);
        $classes = trim(implode(' ', $classes));

        return $classes;

    } else {

        return null;

    }

}
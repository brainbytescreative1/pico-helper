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

function get_sizing_bbc($field) {

    if ( $field ) {
        // initialize
        $classes = [];
        $styles = [];

        $width_percent = $field['width_percent'];
        $width_px = $field['width_px'];
        /*
        $height_pecent = $field['height_pecent'];
        $height_px = $field['height_px'];
        */

        $max_width = $field['max_width'];
        $alignment = $field['alignment'];
        $breakpoint = $field['breakpoint'];

        if ( $breakpoint ) {
            $breakpoint = $breakpoint . '-';
        }

        if ( $alignment ) {
            $classes[] = match ($alignment) {
                'start' => 'ms-'. $breakpoint .'0 me-'. $breakpoint .'auto text-' . $breakpoint . 'start',
                'center' => 'mx-'. $breakpoint .'auto text-' . $breakpoint . 'center',
                'end' => 'ms-'. $breakpoint .'auto me-'. $breakpoint .'0 text-' . $breakpoint . 'end',
            };
        }

        if ( $max_width && ( $max_width !== 'default' ) ) {
            $classes[] = 'mw-' . $breakpoint . $max_width;
        }

        if ( $width_px ) {
            $styles[] = 'width: ' . $width_px . 'px;';
        } elseif ( $width_percent && ( $width_percent !== 'default' ) ) {
            $classes[] = 'w-' . $width_percent;
        }

        /*
        if ( $height_px ) {
            $styles[] = 'height: ' . $height_px . 'px;';
            $classes[] = 'img-has-height';
        } elseif ( $height_pecent && ( $height_pecent !== 'default' ) ) {
            $classes[] = 'h-' . $height_pecent;
            $classes[] = 'img-has-height';
        } else {
            $styles[] = 'height: auto;';
        }
        */

        $classes = array_unique($classes);
        $classes = trim(implode(' ', $classes));
        $styles = array_unique($styles);
        $styles = trim(implode(' ', $styles));

        $return_array = [
            'classes' => $classes,
            'styles' => $styles,
        ];

        return $return_array;
    }

}
<?php

function get_flex_bbc( $field, $breakpoint = false ) {

    $classes = [];

    if ( $field ) {

        $enable_flex = $field['enable_flex'];

        if ( $enable_flex == 'enable' ) {

            $classes[] = 'd-flex';

            $mobile_flex = $field['mobile_flex'];
            if ( ( $mobile_flex === 'disable' ) && ( !$breakpoint ) ) {
                $breakpoint = 'lg';
            }

            $flex_direction = $field['flex_direction'];
            $flex_wrap = $field['flex_wrap'];
            $align_content = $field['align_content'];
            $justify_content = $field['justify_content'];
            $align_items = $field['align_items'];

            $last_element = $field['last_element'];

            if ( $flex_direction !== 'normal' ) {
                if ( $mobile_flex === 'disable' ) {
                    $classes[] = str_replace('flex-', 'flex-' . $breakpoint . '-', $flex_direction);
                    $classes[] = 'flex-column';
                } else {
                    $classes[] = $flex_direction;
                }
            }
            if ( $flex_wrap !== 'normal' ) {
                if ( $mobile_flex === 'disable' ) {
                    $classes[] = str_replace('flex-', 'flex-' . $breakpoint . '-', $flex_wrap);
                    $classes[] = 'wrap';
                } else {
                    $classes[] = $flex_wrap;
                }
            }
            if ( $align_content !== 'normal' ) {
                if ( $mobile_flex === 'disable' ) {
                    $classes[] = str_replace('align-content-', 'align-content-' . $breakpoint . '-', $align_content);
                    $classes[] = 'align-content-stretch';
                } else {
                    $classes[] = $align_content;
                }
            }
            if ( $justify_content !== 'normal' ) {
                if ( $mobile_flex === 'disable' ) {
                    $classes[] = str_replace('justify-content-', 'justify-content-' . $breakpoint . '-', $justify_content);
                    $classes[] = 'justify-content-start';
                } else {
                    $classes[] = $justify_content;
                }
            }
            if ( $align_items !== 'normal' ) {
                if ( $mobile_flex === 'disable' ) {
                    $classes[] = str_replace('align-items-', 'align-items-' . $breakpoint . '-', $align_items);
                    $classes[] = 'align-items-start';
                } else {
                    $classes[] = $align_items;
                }
                $classes[] = $align_items;
            }

        }

        $classes = trim(implode(' ', $classes));

        return $classes;

    } else {

        return null;

    }

}
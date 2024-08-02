<?php

function get_text_styles_bbc($field) {

    if ( $field ) {

        $classes = [];

        // add fields to classes
        $mobile_alignment = '';
        if ( isset ( $field['alignment_mobile'] ) ) {
            $mobile_alignment = $field['alignment_mobile'];
            if ( $mobile_alignment ) {
                if ( $mobile_alignment === 'left' ) {
                    $mobile_alignment = 'start';
                } elseif ( $mobile_alignment === 'right' ) {
                    $mobile_alignment = 'end';
                }
                $classes[] = 'text-' . $mobile_alignment;
            }
        }
        $mobile_breakpoint = '';
        if ( isset ( $field['mobile_breakpoint'] ) ) {
            $mobile_breakpoint = $field['mobile_breakpoint'];
            if ( !$mobile_breakpoint ) {
                $mobile_breakpoint = 'lg';
            }
        }
        if ( isset ( $field['remove_bottom_margin'] ) ) {
            $remove_bottom_margin = $field['remove_bottom_margin'];
            if ( $remove_bottom_margin === 'remove' ) {
                $classes[] = 'mb-0';
            }
        }
        if ( isset ( $field['alignment'] ) ) {
            $alignment = $field['alignment'];
            if ( $alignment ) {
                if ( $alignment === 'left' ) {
                    $alignment = 'start';
                } elseif ( $alignment === 'right' ) {
                    $alignment = 'end';
                }
                if ( $mobile_alignment ) {
                    $classes[] = 'text-'. $mobile_breakpoint .'-' . $alignment;
                } else {
                    $classes[] = 'text-' . $alignment;
                }
            }
        }
        if ( isset ( $field['theme_colors'] ) ) {
            if ( $field['theme_colors'] ) {
                $classes[] = 'text-' . $field['theme_colors'];
            }
        }
        if ( isset ( $field['font_size'] ) ) {
            if ( $field['font_size'] && ( $field['font_size'] !== 'default' ) ) {
                $classes[] = $field['font_size'];
            }
        }
        if ( isset ( $field['font_weight'] ) ) {
            if ( $field['font_weight'] && ( $field['font_weight'] !== 'default' ) ) {
                $classes[] = 'fw-' . $field['font_weight'];
            }
        }
        if ( isset ( $field['line_height'] ) ) {
            if ( $field['line_height'] && ( $field['line_height'] !== 'default' ) ) {
                $classes[] = 'lh-' . $field['line_height'];
            }
        }
        if ( isset ( $field['font_family'] ) ) {
            if ( $field['font_family'] ) {
                $classes[] = 'font-' . $field['font_family'];
            }
        }
        if ( isset ( $field['text_transform'] ) ) {
            if ( $field['text_transform'] ) {
                $classes[] = 'text-' . $field['text_transform'];
            }
        }
        if ( isset ( $field['text_decoration'] ) ) {
            if ( $field['text_decoration'] ) {
                $classes[] = 'text-decoration-' . $field['text_decoration'];
            }
        }
        if ( isset ( $field['additional_classes'] ) ) {
            if ( $field['additional_classes'] ) {
                $classes[] = $field['additional_classes'];
            }
        }
        
        if ( $classes ) {
            return trim(implode(' ', array_unique($classes)));
        }

    }    

}
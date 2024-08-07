<?php

function get_spacing_bbc( $field, $field_type = false, $classes = false ) {

    $classes = [];

    // get padding all values
    $padding_all = $field['padding_all'];

    // container defaults
    if ( $field_type === 'container' ) {

        if ( $padding_all && ( $padding_all === 'default' ) ) {

            $container_spacing_desktop = get_field('container_spacing_desktop', 'layout');
            if ( $container_spacing_desktop && ( $container_spacing_desktop !== 'default' ) ) {
                $classes[] = 'py-lg-' . $container_spacing_desktop;
            } else {
                $classes[] = 'py-3';
            }

            $container_spacing_mobile = get_field('container_spacing_mobile', 'layout');
            if ( $container_spacing_mobile && ( $container_spacing_mobile !== 'default' ) ) {
                $classes[] = 'py-' . $container_spacing_mobile;
            } else {
                $classes[] = 'py-2';
            }
        }

        $classes[] = 'px-0';

    }

    if ( $field ) {

        // spacing all
        if ( $padding_all && ( $padding_all !== 'default' ) ) {
            if ( $padding_all === 'none' ) {
                $classes[] = 'p-0';
            }
            /*
            $classes[] = 'px-lg-' . $padding_all;
            $classes[] = 'px-' . $padding_all;
            $classes[] = 'py-lg-' . $padding_all;
            $classes[] = 'py-' . $padding_all;
            $classes[] = 'p-lg-' . $padding_all;
            $classes[] = 'p-' . $padding_all;
            */
        }

        $margin_all = $field['margin_all'];
        if ( $margin_all && ( $margin_all !== 'default' ) ) {
            if ( $margin_all === 'none' ) {
                $margin_all = '0';
            }
            $classes[] = 'mx-lg-' . $margin_all;
            $classes[] = 'mx-' . $margin_all;
            $classes[] = 'my-lg-' . $margin_all;
            $classes[] = 'my-' . $margin_all;
            $classes[] = 'm-lg-' . $margin_all;
            $classes[] = 'm-' . $margin_all;
        }

        // custom spacing
        $desktop_padding = $field['desktop_padding'];
        $desktop_margin = $field['desktop_margin'];
        $mobile_padding = $field['mobile_padding'];
        $mobile_margin = $field['mobile_margin'];

        // desktop padding
        if ( $desktop_padding['padding_top'] ) {
            if ( $desktop_padding['padding_top'] == 'none' ) {
                $desktop_padding['padding_top'] = '0';
            }
            $classes[] = 'pt-lg-'. $desktop_padding['padding_top'];
        }
        if ( $desktop_padding['padding_right'] ) {
            if ( $desktop_padding['padding_right'] == 'none' ) {
                $desktop_padding['padding_right'] = '0';
            }
            $classes[] = 'pe-lg-'. $desktop_padding['padding_right'];
        }
        if ( $desktop_padding['padding_bottom'] ) {
            if ( $desktop_padding['padding_bottom'] == 'none' ) {
                $desktop_padding['padding_bottom'] = '0';
            }
            $classes[] = 'pb-lg-'. $desktop_padding['padding_bottom'];
        }
        if ( $desktop_padding['padding_left'] ) {
            if ( $desktop_padding['padding_left'] == 'none' ) {
                $desktop_padding['padding_left'] = '0';
            }
            $classes[] = 'ps-lg-'. $desktop_padding['padding_left'];
        }

        // desktop margin
        if ( $desktop_margin['margin_top'] ) {
            if ( $desktop_margin['margin_top'] == 'none' ) {
                $desktop_margin['margin_top'] = '0';
            }
            $classes[] = 'mt-lg-'. $desktop_margin['margin_top'];
        }
        if ( $desktop_margin['margin_right'] ) {
            if ( $desktop_margin['margin_right'] == 'none' ) {
                $desktop_margin['margin_right'] = '0';
            }
            $classes[] = 'me-lg-'. $desktop_margin['margin_right'];
        }
        if ( $desktop_margin['margin_bottom'] ) {
            if ( $desktop_margin['margin_bottom'] == 'none' ) {
                $desktop_margin['margin_bottom'] = '0';
            }
            $classes[] = 'mb-lg-'. $desktop_margin['margin_bottom'];
        }
        if ( $desktop_margin['margin_left'] ) {
            if ( $desktop_margin['margin_left'] == 'none' ) {
                $desktop_margin['margin_left'] = '0';
            }
            $classes[] = 'ms-lg-'. $desktop_margin['margin_left'];
        }

        // mobile padding
        if ( $mobile_padding['padding_top'] ) {
            if ( $mobile_padding['padding_top'] == 'none' ) {
                $mobile_padding['padding_top'] = '0';
            }
            $classes[] = 'pt-'. $mobile_padding['padding_top'];
        }
        if ( $mobile_padding['padding_right'] ) {
            if ( $mobile_padding['padding_right'] == 'none' ) {
                $mobile_padding['padding_right'] = '0';
            }
            $classes[] = 'pe-'. $mobile_padding['padding_right'];
        }
        if ( $mobile_padding['padding_bottom'] ) {
            if ( $mobile_padding['padding_bottom'] == 'none' ) {
                $mobile_padding['padding_bottom'] = '0';
            }
            $classes[] = 'pb-'. $mobile_padding['padding_bottom'];
        }
        if ( $mobile_padding['padding_left'] ) {
            if ( $mobile_padding['padding_left'] == 'none' ) {
                $mobile_padding['padding_left'] = '0';
            }
            $classes[] = 'ps-'. $mobile_padding['padding_left'];
        }

        // mobile margin
        if ( $mobile_margin['margin_top'] ) {
            if ( $mobile_margin['margin_top'] == 'none' ) {
                $mobile_margin['margin_top'] = '0';
            }
            $classes[] = 'mt-'. $mobile_margin['margin_top'];
        }
        if ( $mobile_margin['margin_right'] ) {
            if ( $mobile_margin['margin_top'] == 'none' ) {
                $mobile_margin['margin_top'] = '0';
            }
            $classes[] = 'me-'. $mobile_margin['margin_right'];
        }
        if ( $mobile_margin['margin_bottom'] ) {
            if ( $mobile_margin['margin_bottom'] == 'none' ) {
                $mobile_margin['margin_bottom'] = '0';
            }
            $classes[] = 'mb-'. $mobile_margin['margin_bottom'];
        }
        if ( $mobile_margin['margin_left'] ) {
            if ( $mobile_margin['margin_left'] == 'none' ) {
                $mobile_margin['margin_left'] = '0';
            }
            $classes[] = 'ms-'. $mobile_margin['margin_left'];
        }

    }

    $classes = trim(implode(' ', $classes));
    return $classes;

}

function get_menu_padding_bbc($field, $classes = false, $styles = false) {

    if ( $field ) {

        if ( !$classes ) {
            $classes = [];
        }
    
        if ( !$styles ) {
            $styles = [];
        }

        if ( $field && ( $field !== 'default' ) ) {
            $padding_styles = [
                '.25rem',
                '.25rem',
                '.5rem',
                '.75rem',
                '1rem',
                '1.25rem',
                '1.5rem',
                '1.75rem',
                '2rem'
            ];
            $padding_classes = [
                '1',
                '2',
                '3',
                '4',
                '5'
            ];
            if ( in_array( $field, $padding_styles ) ) {
                $styles[] = 'padding-top: '. $field . ';';
                $styles[] = 'padding-bottom: '. $field . ';';
            } elseif ( in_array( $field, $padding_classes ) ) {
                $classes[] = 'py-lg-' . $field;
            }
        }

        $return_array = [
            'classes' => $classes, 
            'styles' => $styles
        ];

        return $return_array;

    } else {
        return null;
    }

}
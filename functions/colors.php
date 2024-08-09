<?php

function get_rgb_color_bbc( $field, $get_field = false, $sub = false ) {
    if ( $field ) {
        $return_color = null;
        if ( $get_field === true ) {
            if ( $sub ) {
                $field = get_sub_field($field);
            } else {
                $field = get_field($field);
            }
        }

        $transparency = null;
        if ( isset ( $field['transparency'] ) ) {
            if ( $field['transparency'] ) {
                $transparency = $field['transparency'];
            }
        }

        if ( !$transparency ) {
            $return_color = 'transparent';
        } else {
            if ( $field['custom_color'] ) {
                if ( $transparency < 100 ) {
                    if ( function_exists('hex_to_rgb') ) {
                        $return_color = hex_to_rgb($field['custom_color'], $transparency);
                    }
                } else {
                    $return_color = $field['custom_color'];
                }
            } elseif ( $field['theme_colors'] ) {
                if ( $transparency < 100 ) {
                    if ( function_exists('hex_to_rgb') ) {
                        $return_color = hex_to_rgb( get_theme_mod('SCSSvar_' . $field['theme_colors'] ), $transparency );
                    }
                } else {
                    $return_color = 'var(--bs-'. $field['theme_colors'] .')';
                }
            }
        }        
        return $return_color;
    } else {
        return null;
    }
}

function hex_to_rgb($hex, $alpha = false) {
    if ( $hex ) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ( $alpha ) {
        $rgb['a'] = $alpha / 100;
        return 'rgba(' . $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'] . ', ' . $rgb['a'] . ')';
        } else {
            return 'rgb(' . $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'] . ')';
        }
    } else {
        return null;
    }
}

function hex_to_rgb_values($hex, $alpha = false) {
    if ( $hex ) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));

        return [
            'r' => $rgb['r'],
            'g' => $rgb['g'],
            'b' => $rgb['b']
        ];
    } else {
        return null;
    }
}

function rgb_bw_contrast($r, $g, $b) {
    $color = array(
        'r' => ($r < 128) ? 255 : 0,
        'g' => ($g < 128) ? 255 : 0,
        'b' => ($b < 128) ? 255 : 0
    );

    if ( ( ( $color['r'] * 0.299 ) + ( $color['g'] * 0.587 ) + ( $color['b'] * 0.114 ) ) > 186 ) {
        return '#ffffff';
    } else {
        return '#000000';
    }
}

function get_color_bbc($field, $return_styles = false, $sub = false ) {

    if ( $field ) {

        // initialize arrays
        $return_array = [];
        $classes = [];
        $styles = [];

        // determine if sub field
        if ( $sub ) {
            $field = get_sub_field($field);
        } else {
            $field = get_field($field);
        }

        $theme_colors = $field['theme_colors'];
        $transparency = $field['transparency'];
        $custom_color = $field['custom_color'];

        if ( $return_styles ) {

            $color = '';

            $transparency = ( $transparency / 100 );

            if ( $custom_color ) {

                $custom_color = str_replace( '#', '', $custom_color );

                $split_hex_color = str_split( $custom_color, 2 );
                $rgb1 = hexdec( $split_hex_color[0] );
                $rgb2 = hexdec( $split_hex_color[1] );
                $rgb3 = hexdec( $split_hex_color[2] );

                return 'rgba('. $rgb1 .', '. $rgb2 .', '. $rgb3 .', '. $transparency .')';

            } else {

                return 'var(--bs-' . $theme_colors . ')';

            }

        }

    }

}

// populate selected colors
add_filter('acf/load_field/name=theme_colors', function($field) {

    $choices = [];

    $color_select = get_field('color_select', 'colors');

    $colors = [
        'primary',
        'secondary',
        'success',
        'info',
        'danger',
        'warning',
        'light',
        'dark',
        'white',
    ];

    $choices += array( 'text' => __('Text', 'bbc') );

    foreach ( $colors as $color ) {
        if ( get_theme_mod('SCSSvar_' . $color) ) {
            $choices += array( $color => __(ucfirst($color), 'bbc') );
        }
    }

    $choices += array( 'white' => __('White', 'bbc') );
    
    $field['choices'] = $choices;
	$field['default_value'] = null;
	return $field;

});

// populate button colors
add_filter('acf/load_field/name=button_color', function($field) {
	
    $choices = [];

    $button_select = get_field('button_select', 'buttons');

    if ( $button_select ) {
        foreach ( $button_select as $button ) {
            $choices += array( $button => __(ucfirst($button), 'bbc') );
        }
    }
    
    $field['choices'] = $choices;
	$field['default_value'] = null;
	return $field;

});

add_filter( 'wp_kses_allowed_html', 'acf_add_allowed_svg_tag', 10, 2 );
function acf_add_allowed_svg_tag( $tags, $context ) {
    if ( $context === 'acf' ) {
        $tags['svg']  = array(
            'xmlns'				=> true,
			'width'			=> true,
			'height'		=> true,
			'preserveAspectRatio'	=> true,
            'fill'				=> true,
            'viewbox'				=> true,
            'role'				=> true,
            'aria-hidden'			=> true,
            'focusable'				=> true,
        );
        $tags['path'] = array(
            'd'    => true,
            'fill' => true,
        );
    }

    return $tags;
}
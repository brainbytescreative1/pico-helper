<?php

// populate divider shapes
add_filter('acf/load_field/name=top_divider_shape', function($field) {

    $choices = [];

    $choices += array( 'none' => __('None', 'bbc') );
	
	$section_dividers = null;
    $section_dividers = get_field('section_dividers', 'dividers');

    if ( $section_dividers ) {
        foreach ( $section_dividers as $divider ) {
            $choices += array( $divider['shape_class'] => __($divider['shape_name'], 'bbc') );
        }
    }
	
	$field['choices'] = $choices;
	$field['default_value'] = 'none';
	return $field;

});

add_filter('acf/load_field/name=bottom_divider_shape', function($field) {

    $choices = [];

    $choices += array( 'none' => __('None', 'bbc') );
	
	$section_dividers = null;
    $section_dividers = get_field('section_dividers', 'dividers');

    if ( $section_dividers ) {
        foreach ( $section_dividers as $divider ) {
            $choices += array( $divider['shape_class'] => __($divider['shape_name'], 'bbc') );
        }
    }
	
	$field['choices'] = $choices;
	$field['default_value'] = 'none';
	return $field;

});

function get_dividers_bbc($position = 'bottom') {

    // initialize classes
    $classes = [];
    $classes[] = 'element';
    $classes[] = 'shape-divider';
    $classes[] = 'divider-' . $position;

    $styles = [];

    // set defaults
    $color = 'primary';
    $flip_horizontally = 'no';
    $invert = 'no';
    $negative_margin = 'no';

    // get divider section fields
    $shape = get_field($position . '_divider_shape');
    $color = get_field($position . '_divider_color');
    $flip_horizontally = get_field($position . '_divider_flip_horizontally');
    $invert = get_field($position . '_divider_invert');
    $negative_margin = get_field($position . '_negative_margin');

    // assign classes
    if ( $color['theme_colors'] ) {
        $classes[] = 'divider-' . $color['theme_colors'];
    }
    if ( $shape ) {
        $classes[] = $shape;
    }
    if ( $flip_horizontally === 'yes' ) {
        $classes[] = 'flip-horizontally';
    }
    if ( $invert === 'yes' ) {
        $classes[] = 'invert';
    }
    /*
    if ( $negative_margin === 'yes' ) {
        $styles[] = 'margin-'. $position . ': var(--divider-'. $shape .'-negative-height);';
    }
    */

    $classes = trim(implode(' ', $classes));
    //$styles = trim(implode(' ', $styles));

    return '<div class="'. $classes .'"><div class="divider-inner"></div></div>';

}
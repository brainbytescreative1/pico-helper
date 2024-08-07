<?php

function get_advanced_bbc($field = false, $sub = true) {

    if ( $field ) {
        if ( $sub = false ) {
            $field = get_field($field);
        } else {
            $field = get_sub_field($field);
        }
    }   

    // initialize
    $classes = [];
    $id = '';

    if ( $field ) {
        // classes
        if ( $field['classes'] ) {
            $classes[] = $field['classes'];
        }
        // id
        if ( $field['unique_id'] ) {
            $id = trim( $field['unique_id'] );
            //$id = $str=preg_replace('/\s+/', '', $id);
        }
    }

    // process
    $advanced = array(
        'classes' => null,
        'id' => null,
    );
    if ( $classes ) {
        $advanced['classes'] = trim(implode(' ', $classes));
    }
    if ( $id ) {
        $advanced['id'] = $id;
    }

    return $advanced;

}
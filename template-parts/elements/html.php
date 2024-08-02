<?php

if( get_row_layout() == 'custom_html' ):

    // initialize classes
    $html_classes = [];

    // add initial classes
    $html_classes[] = 'element';
    $html_classes[] = 'custom-html';

    // classes
    $additional_classes = get_sub_field('additional_classes');
    if ( $additional_classes ) {
        $html_classes[] = $additional_classes;
    }

    // spacing
    if ( function_exists('get_spacing_bbc') ) {
        $html_classes[] = get_spacing_bbc(get_sub_field('html_spacing'));
    }

    // convert array to string
    $html_classes = trim(implode(' ', $html_classes));

    echo '<div class="'. esc_attr($html_classes) .'">'; // html element start

        // html
        $html = get_sub_field('html');
        if ( $html ) {
            echo $html;
        }

        // js
        $js = get_sub_field('js');
        if ( $js ) {
            echo $js;
        }

        // css
        $css = get_sub_field('css');
        if ( $css ) {
            echo $css;
        }

    echo '</div>'; // html element end
    
endif;
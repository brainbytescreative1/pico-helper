<?php

// top menu options
$top_menu_select = get_field('top_menu_select', 'header');
if ( get_field('top_menu_select', 'header') ) {

    $classes = [];
    $styles = [];

    $classes[] = 'top-menu';
    $classes[] = 'top-menu-' . $top_menu_select;
    
    // top menu background
    $top_menu_bg = if_array_value( get_field('top_menu_background', 'header'), 'theme_colors');
    if ( $top_menu_bg ) {
        $classes[] = 'bg-' . $top_menu_bg;
    }

    // top menu color
    $top_menu_color = if_array_value( get_field('top_menu_item_color', 'header'), 'theme_colors');
    if ( $top_menu_color ) {
        $classes[] = 'text-' . $top_menu_color;
    }

    // align
    $top_menu_align = get_field('top_menu_align', 'header');
    $top_menu_align_mobile = get_field('top_menu_align_mobile', 'header');

    if ( $top_menu_align ) {
        $top_menu_align = match ($top_menu_align) {
            'left' => 'text-lg-start',
            'center' => 'text-lg-center',
            'right' => 'text-lg-end',
        };
    } else {
        $top_menu_align = 'text-lg-end';
    }

    if ( $top_menu_align_mobile ) {
        $top_menu_align_mobile = match ($top_menu_align_mobile) {
            'left' => 'text-start',
            'center' => 'text-center',
            'right' => 'text-end',
        };
    } else {
        $top_menu_align_mobile = 'text-center';
    }

    // top menu padding
    $top_menu_padding = get_field('top_menu_padding', 'header');
    if ( $top_menu_padding !== 'default' ) {
        if ( $top_menu_padding === 'custom' ) {
            $top_menu_padding_custom = get_field('top_menu_padding_custom', 'header');
            if ( $top_menu_padding_custom ) {
                $top_menu_padding = $top_menu_padding_custom . 'rem';
            }
        }
        if ( $top_menu_padding ) {
            $styles[] = 'padding-top: ' . $top_menu_padding . ';';
            $styles[] = 'padding-bottom: ' . $top_menu_padding . ';';
        }
    }

    $classes = trim( implode(' ', $classes) );
    $styles = trim( implode(' ', $styles) );

    echo '<div class="'. $classes .'" style="'. $styles .'">';
    if ( $top_menu_select === 'menu' ) {
        echo '<div class="'. get_field('header_width', 'header') .'">';
            echo '<div class="row">';
                wp_nav_menu(
                    array(
                        'theme_location' => 'secondary',
                        'container' => false,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-top mb-0 '. $top_menu_align .' '. $top_menu_align_mobile .' %2$s">%3$s</ul>',
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    )
                );
            echo '</div>';
        echo '</div>';
    } elseif ( $top_menu_select === 'widget' ) {
        dynamic_sidebar( 'topmenu' );
    }
    echo '</div>';

}
?>
<?php

if( get_row_layout() == 'heading' ):

    $classes = [];

    // content
    $text = get_sub_field('text');
    $tag = get_sub_field('tag');

    // options
    $page_title = get_sub_field('page_title');
    $line_through = get_sub_field('line_through');

    if ( $text && $tag ) {

        // process global functions
        $classes[] = 'element';
        $styles = [];

        if ( function_exists('get_text_styles_bbc') ) {
            $classes[] = get_text_styles_bbc(get_sub_field('text_styles'));
        }
        if ( function_exists('get_spacing_bbc') ) {
            $classes[] = get_spacing_bbc(get_sub_field('heading_spacing'));
        }

        if ( $page_title === 'enabled' ) {
            $classes[] = 'page-title';
        }
        
        if ( $line_through === 'enabled' ) {
            $rand = rand(1, 9999);
            $classes[] = 'line-through';
    
            $line_size = get_sub_field('line_size');
            $line_color = get_sub_field('line_color');

            $text = '<span id="line-'. $rand .'">' . $text . '</span>';
            ?>
            <style>
                #line-<?=$rand?>:before,
                #line-<?=$rand?>:after { 
                    border-color: var(--<?=$line_color['theme_colors']?>); 
                    border-width: <?=$line_size?>px;
                }
            </style>
            <?php
        }

        $sizing = get_sub_field('sizing');
        if ( function_exists('get_sizing_bbc') ) {
            $sizing = get_sizing_bbc(get_sub_field('sizing'));
            $classes[] = $sizing['classes'];
            $styles[] = $sizing['styles'];
        }

        $classes = esc_attr(trim(implode(' ', array_unique($classes))));
        $styles = esc_attr(trim(implode(' ', array_unique($styles))));

        echo '<' . $tag . ' class="'. $classes .'" style="'. $styles .'">' . $text . '</' . $tag . '>';
        

    }

    echo "\r\n";

endif;
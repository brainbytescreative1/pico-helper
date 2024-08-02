<?php

if( get_row_layout() == 'heading' ):

    $heading_classes = [];

    // content
    $text = get_sub_field('text');
    $tag = get_sub_field('tag');

    // options
    $page_title = get_sub_field('page_title');
    $line_through = get_sub_field('line_through');

    if ( $text && $tag ) {

        // process global functions
        $heading_classes[] = 'element';

        if ( function_exists('get_text_styles_bbc') ) {
            $heading_classes[] = get_text_styles_bbc(get_sub_field('text_styles'));
        }
        if ( function_exists('get_spacing_bbc') ) {
            $heading_classes[] = get_spacing_bbc(get_sub_field('heading_spacing'));
        }

        if ( $page_title === 'enabled' ) {
            $heading_classes[] = 'page-title';
        }
        
        if ( $line_through === 'enabled' ) {
            $rand = rand(1, 9999);
            $heading_classes[] = 'line-through';
    
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

        $heading_classes = trim(implode(' ', $heading_classes));

        echo '<' . $tag . ' class="'. esc_attr($heading_classes) .'">' . $text . '</' . $tag . '>';
        

    }

    echo "\r\n";

endif;
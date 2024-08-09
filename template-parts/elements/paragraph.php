<?php

if( get_row_layout() == 'paragraph' ):
                
    // content
    $text = get_sub_field('text');

    if ( $text ) {

        $classes = [];
        $classes[] = 'text-wrapper';
        $classes[] = 'element';
        $styles = [];

        // style
        $remove_margin = get_sub_field('remove_margin_from_last_paragraph');
        if( $remove_margin && in_array('Remove', $remove_margin) ) {
            $classes[] = 'no-margin-bottom';
        }

        if ( function_exists('get_text_styles_bbc') ) {
            $classes[] = get_text_styles_bbc(get_sub_field('text_styles'));
        }

        if ( function_exists('get_spacing_bbc') ) {
            $classes[] = get_spacing_bbc(get_sub_field('paragraph_spacing'));
        }

        $sizing = get_sub_field('sizing');
        if ( function_exists('get_sizing_bbc') ) {
            $sizing = get_sizing_bbc(get_sub_field('sizing'));
            $classes[] = $sizing['classes'];
            $styles[] = $sizing['styles'];
        }

        $additional_classes = get_sub_field('additional_classes');
        if ( $additional_classes ) {
            $classes[] = $additional_classes;
        }

        $classes = esc_attr(trim(implode(' ', array_unique($classes))));
        $styles = esc_attr(trim(implode(' ', array_unique($styles))));

        ?>
        <div class="<?=$classes;?>" style="<?=$styles?>">
            <?=$text;?>
        </div>
        <?php

    }

    echo "\r\n";

endif;
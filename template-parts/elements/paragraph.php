<?php

if( get_row_layout() == 'paragraph' ):
                
    // content
    $text = get_sub_field('text');

    if ( $text ) {

        $classes = [];
        $classes[] = 'text-wrapper';
        $classes[] = 'element';

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
            //print_r($sizing);
            $classes[] = $sizing['classes'];
        }

        

        $additional_classes = get_sub_field('additional_classes');
        if ( $additional_classes ) {
            $classes[] = $additional_classes;
        }

        $classes = trim(implode(' ', $classes));

        ?>
        <div class="<?=$classes;?>">
            <?=$text;?>
        </div>
        <?php

    }

    echo "\r\n";

endif;
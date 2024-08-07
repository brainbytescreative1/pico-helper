<?php

if( get_row_layout() == 'divider' ):

    // get fields
    $divider = get_sub_field('divider');

    if ( $divider ) {

        // initialize arrays
        $divider_classes = [];
        $divider_styles = [];

        // add initial classes
        $divider_classes[] = 'divider';
        $divider_classes[] = 'element';

        // width and height
        if ( $divider['width'] ) {
            $value = $divider['width']['value'];
            if ( $value ) {
                $unit = $divider['width']['unit'];
                $divider_styles[] = 'width: ' . $value . $unit . ';';
            }
        }

        if ( $divider['height'] ) {
            $value = $divider['height']['value'];
            if ( $value ) {
                $unit = $divider['height']['unit'];
                $divider_styles[] = 'height: ' . $value . $unit . ';';
            }
        }

        // color
        $divider_color = $divider['theme_colors'];
        if ( $divider_color ) {
            $divider_classes[] = 'bg-' . $divider_color;
        }

        $alignment = $divider['alignment'];
        if ( $alignment ) {
            $alignment = match ($alignment) {
                'left' => 'ms-0 me-auto',
                'center' => 'ms-auto me-auto',
                'right' => 'ms-auto me-0',
            };
            $divider_classes[] = $alignment;
        }
        

        $additional_classes = $divider['additional_classes'];
        if ( $additional_classes ) {
            $divider_classes[] = $additional_classes;
        }

        if ( function_exists('get_spacing_bbc') ) {
            $divider_classes[] = get_spacing_bbc($divider['divider_spacing']);
        }

        // process divider classes and styles
        $divider_classes = trim(implode(' ', $divider_classes));
        $divider_styles = trim(implode(' ', $divider_styles));
        
        ?>

        <div class="divider-wrapper">
            <p class="<?=esc_attr($divider_classes)?>" style="<?=esc_attr($divider_styles)?>"></p>
        </div>

    <?php }

endif;
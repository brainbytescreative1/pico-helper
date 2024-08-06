<?php

// isset array values
function if_array_value($field = false, $key = false, $prefix = false, $suffix = false) {
    if ( $field && $key ) {
        if ( isset ( $field[$key] ) ) {
            if ( $field[$key] ) {
                return $field[$key];
            }
        }
    }
}

// icons
function get_icon_bbc($field) {
    if ( $field ) {
        
        $icon = '';

        if ( $field['add_icon'] ) {

            $icon_classes = [];
            $icon_styles = [];

            $styles = $field['icon_styles'];
            if ( $styles ) {
                
                if ( $styles['custom_color'] ) {
                    $icon_styles[] = 'color: ' . $styles['custom_color'] . ';';
                } elseif ( $styles['theme_colors'] ) {
                    $icon_classes[] = 'text-' . $styles['theme_colors'];
                }
                $font_size = $styles['font_size'];
                if ( $font_size['value'] ) {
                    $icon_styles[] = 'font-size: ' . $font_size['value'] . $font_size['unit'] . ';';
                }
                $width = $styles['width'];
                if ( $width['value'] ) {
                    $icon_styles[] = 'width: ' . $width['value'] . $width['unit'] . ';';
                }
                $height = $styles['height'];
                if ( $height['value'] ) {
                    $icon_styles[] = 'height: ' . $height['value'] . $height['unit'] . ';';
                }
                if ( $styles['icon_classes'] ) {
                    $icon_classes[] = $styles['icon_classes'];
                }

            }

            $icon_classes = implode(' ', $icon_classes);
            $icon_styles = implode(' ', $icon_styles);

            if ( $field['add_icon'] === 'bootstrap' ) {
                $icon = $field['bootstrap_icon'];
                $icon = '<i class="bi bi-'. $icon . ' ' . $icon_classes .'" style="'. $icon_styles .'"></i>';
            } elseif ( $field['add_icon'] === 'fa' ) {
                $icon = $field['font_awesome_icon'];
                $icon = '<i class="'. $icon . ' ' . $icon_classes .'" aria-hidden="true" style="'. $icon_styles .'"></i>';
            } elseif ( $field['add_icon'] === 'image' ) {
                $icon = $field['image_icon'];
                if ( $icon['url'] ) {
                    $icon = '<img class="'. $icon_classes .'" style="'. $icon_styles .'" src="'. $icon['url'] .'" alt="" />';
                }
            } elseif ( $field['add_icon'] === 'svg' ) {
                /*
                $svg_icon = str_replace('<svg', '<svg style="'. $icon_styles .' fill: '. $svg_color .'" viewBox="0 0 '. $svg_width .' '. $svg_height .'"', $svg_icon);
                $icon = '<div class="'. $icon_classes .'">' . $svg_icon . '</div>';
                */
            }
            return $icon;
        }
    }
}
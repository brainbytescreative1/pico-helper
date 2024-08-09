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
        
        if ( if_array_value($field, 'add_icon') ) {

            $icon_classes = [];
            $icon_styles = [];

            $icon_classes[] = 'icon-element';

            $styles = if_array_value($field, 'icon_styles');
            if ( $styles ) {
                
                if ( if_array_value($styles, 'custom_color') ) {
                    $icon_styles[] = 'color: ' . if_array_value($styles, 'custom_color') . ';';
                } elseif ( if_array_value($styles, 'theme_colors') ) {
                    $icon_classes[] = 'text-' . if_array_value($styles, 'theme_colors');
                }
                $font_size = if_array_value($styles, 'font_size');
                if ( $font_size['value'] ) {
                    $icon_styles[] = 'font-size: ' . if_array_value($font_size, 'value') . if_array_value($font_size, 'unit') . ';';
                }
                $width = if_array_value($styles, 'width');
                if ( $width['value'] ) {
                    $icon_styles[] = 'width: ' . if_array_value($width, 'value') . if_array_value($width, 'unit') . ';';
                }
                $height = if_array_value($styles, 'height');
                if ( $height['value'] ) {
                    $icon_styles[] = 'height: ' . if_array_value($height, 'value') . if_array_value($height, 'unit') . ';';
                }
                $position = if_array_value($styles, 'position');
                if ( $position ) {
                    $icon_classes[] = 'icon-' . $position;                    
                }
                if ( $styles['icon_classes'] ) {
                    $icon_classes[] = if_array_value($styles, 'icon_classes');
                }

            }

            $icon_classes = trim(implode(' ', $icon_classes));
            $icon_styles = trim(implode(' ', $icon_styles));

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
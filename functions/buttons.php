<?php

function get_buttons_bbc( $field ) {

    if ( $field ) {

        $buttons = $field['buttons'];

        if ( $buttons ) {

            // start content
            ob_start();

            $button_group_classes = [];

            $button_group_classes[] = 'button-group';
            $button_group_classes[] = 'element';

            $alignment = $field['alignment'];
            $mobile_breakpoint = 'lg';
            if ( $field['mobile_breakpoint'] && ( $field['mobile_breakpoint'] !== 'default' ) ) {
                $mobile_breakpoint = $field['mobile_breakpoint'];
            }
            
            if ( $field['space_between'] !== 'default' ) {
                $button_group_classes[] = 'gap-' . $mobile_breakpoint . '-' . $field['space_between'];
                $button_group_classes[] = 'gap-1';
            } else {
                $button_group_classes[] = 'gap-1';
            }

            $button_width = null;

            $full_width_mobile = $field['full_width_mobile'];

            switch ($alignment) {
                case 'left':
                    if ( $full_width_mobile === 'disabled' ) {
                        $button_group_classes[] = 'd-flex';
                    } else {
                        $button_group_classes[] = 'd-grid';
                        $button_group_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                    }
                    break;
                case 'center':
                    if ( $full_width_mobile === 'disabled' ) {
                        $button_group_classes[] = 'd-flex';
                        $button_group_classes[] = 'justify-content-center';
                    } else {
                        $button_group_classes[] = 'd-grid';
                        $button_group_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                        $button_group_classes[] = 'justify-content-'. $mobile_breakpoint .'-center';
                    }
                    break;
                case 'right':
                    if ( $full_width_mobile === 'disabled' ) {
                        $button_group_classes[] = 'd-flex';
                        $button_group_classes[] = 'justify-content-end';
                    } else {
                        $button_group_classes[] = 'd-grid';
                        $button_group_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                        $button_group_classes[] = 'justify-content-'. $mobile_breakpoint .'-end';
                    }
                    break;
                case 'auto-resize':
                    if ( $full_width_mobile === 'disabled' ) {
                        $button_group_classes[] = 'd-flex';
                        $button_width = 'col-' . ( 12 / count($buttons) );
                    } else {
                        $button_group_classes[] = 'd-grid';
                        $button_group_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                        $button_width = 'col-'. $mobile_breakpoint .'-' . ( 12 / count($buttons) );
                    }
                    $button_group_classes[] = 'btn-group';
                    break;
                case 'stacked':
                    $button_group_classes[] = 'd-grid';
                    break;
                default;
                    if ( $full_width_mobile === 'disabled' ) {
                        $button_group_classes[] = 'd-flex';
                    } else {
                        $button_group_classes[] = 'd-grid';
                        $button_group_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                    }
                    break;
            }

            // get custom spacing
            if ( function_exists('get_spacing_bbc') ) {
                $button_group_classes[] = get_spacing_bbc($field['buttons_spacing']);
            }

            // advanced
            $button_group_classes[] = $field['additional_classes'];

            // process button group styles
            $button_group_classes = trim(implode(' ', $button_group_classes));

            echo '<div class="'. $button_group_classes .'" role="group">';

            foreach ( $buttons as $button ) {
                
                $button_link = $button['button_link'];

                if ( $button_link ) {

                    $url = $button_link['url'];

                    if ( $url ) {
                        $title = '';
                        $target = '';

                        $button_classes = [];
                        $button_styles = [];
                        $text_classes = [];
                        
                        // content
                        $title = $button_link['title'];
                        $target = $button_link['target'];
                        if ( $target ) {
                            $target = ' target="' . $target . ' "';
                        }

                        // style
                        $button_classes[] = 'button';
                        $button_classes[] = 'element';
                        $button_color = $button['button_color'];
                        $button_font = $button['button_font'];
                        if ( $button_font && ( $button_font !== 'default' ) ) {
                            $text_classes[] = 'font-' . $button_font;
                        }

                        // button style
                        $button_style = $button['button_style'];
                        if ( $button_style == 'solid' ) {
                            $button_classes[] = 'btn';
                            $button_classes[] = 'btn-'. $button_color;
                        } elseif ( $button_style == 'outline' ) {
                            $button_classes[] = 'btn';
                            $button_classes[] = 'btn-'. $button_style . '-' . $button_color;
                            $button_classes[] = 'btn-outline';
                        } elseif ( $button_style == 'link' ) {
                            $button_classes[] = 'btn-link';
                            $button_classes[] = 'text-' . $button_color;
                            $button_classes[] = 'text-decoration-none';
                        } elseif ( $button_style == 'underline' ) {
                            $button_classes[] = 'btn-link';
                            $button_classes[] = 'text-decoration-none';
                            $button_classes[] = 'text-' . $button_color;
                            $button_classes[] = 'text-decoration-underline';
                        }

                        // button size
                        $button_size = $button['button_size'];
                        if ( $button_size != 'normal' ) {
                            $button_classes[] = 'btn-'. $button_size;
                        }

                        $button_classes[] = $button_width;

                        // icon
                        $button_icon = get_icon_bbc($button['button_icon']);
                        $icon_position = if_array_value($button, 'icon_position');
                        if ( $icon_position ) {
                            $button_classes[] = 'icon-' . $icon_position;
                        }

                        // additional classes
                        $additional_classes = $button['additional_classes'];
                        if ( $additional_classes ) {
                            $button_classes[] = $additional_classes;
                        }
                        
                        // process button styles
                        $button_classes = esc_attr(trim(implode(' ', array_unique($button_classes))));
                        $button_styles = implode(' ', $button_styles);
                        $text_classes = implode(' ', $text_classes);

                        $button_tag_start = '<a type="button" href="'. esc_attr($url) .'" title="'. esc_attr($title) .'" class="'. esc_attr($button_classes) .' '. esc_attr($text_classes) .'" style="'. esc_attr($button_styles) .'"'. $target .'>';

                            if ( $text_classes ) {
                                $button_content = '<span class="button-text '. $text_classes .'">' . esc_attr($title) . '</span>';
                            } else {
                                $button_content = esc_attr($title);
                            }

                        $button_tag_end = '</a>';

                        if ( $button_icon && ( ( $icon_position === 'left' ) || ( $icon_position === 'top' ) ) ) {
                            echo $button_tag_start . $button_icon . $button_content . $button_tag_end;
                        } elseif ( $button_icon && ( ( $icon_position === 'right' ) || ( $icon_position === 'bottom' ) ) ) {
                            echo $button_tag_start . $button_content . $button_icon . $button_tag_end;
                        } else {
                            echo $button_tag_start . $button_content . $button_tag_end;
                        }

                    }

                }

            }

            echo '</div>';

            // return content
            return ob_get_clean();

        } else {

            return null;
            
        }

    }

}
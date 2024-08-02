<?php

function get_buttons_bbc( $field ) {

    if ( $field ) {

        $buttons = $field['buttons'];

        if ( $buttons ) {

            // start content
            ob_start();

            $button_group_classes = [];

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
                        $button_classes[] = 'element';
                        $button_color = $button['button_color'];
                        $button_font = $button['button_font'];
                        if ( $button_font && ( $button_font !== 'default' ) ) {
                            $text_classes[] = 'font-' . $button_font;
                        }

                        // button style
                        $button_style = $button['button_style'];
                        if ( $button_style == 'underline' ) {
                            $button_classes[] = 'btn';
                            $button_classes[] = 'btn-link';
                            $button_classes[] = 'btn-underline';
                            $button_classes[] = 'btn-'. $button_color;
                            $text_classes[] = 'text-'. $button_color;
                            $button_classes[] = 'rounded-0';
                            $button_classes[] = 'border-' . $button_color;
                        } elseif ( $button_style == 'outline' ) {
                            $button_classes[] = 'btn';
                            $button_classes[] = 'btn-'. $button_style . '-' . $button_color;
                            $button_classes[] = 'btn-outline';
                        } elseif ( $button_style == 'link' ) {
                            $button_classes[] = 'btn';
                            $button_classes[] = 'btn-link';
                            $button_classes[] = 'text-'. $button_color;
                            $button_classes[] = 'text-'. $button_color;
                        } else {
                            $button_classes[] = 'btn';
                            $button_classes[] = 'btn-'. $button_color;
                        }

                        // button size
                        $button_size = $button['button_size'];
                        if ( $button_size != 'normal' ) {
                            $button_classes[] = 'btn-'. $button_size;
                        }

                        $button_classes[] = $button_width;

                        // icon / image
                        $button_icon = null;
                        $button_icon_styles = null;
                        $add_icon_image = $button['add_icon_image'];

                        if ( $add_icon_image === 'icon' ) {

                            $icon_classes = [];
                            $button_icon = $button['button_icon'];
                            if ( $button_icon ) {
                                $icon_classes[] = $button_icon;
                            }
                            $button_icon_color = $button['icon_color'];
                            if ( $button['icon_color']['theme_colors'] ) {
                                $icon_classes[] = 'text-' . $button['icon_color']['theme_colors'];
                            }
                            $icon_position = $button['icon_position'];
                            if ( $icon_position ) {
                                $icon_classes[] = 'icon-' . $button['icon_position'];
                            }
                            $icon_classes = implode(' ', $icon_classes);
                            
                            $icon_styles = [];
                            $icon_size = $button['icon_size'];
                            if ( $icon_size ) {
                                $icon_styles[] = 'font-size: ' . $icon_size . 'px;';
                            }
                            $icon_styles = implode(' ', $icon_styles);
                        
                            if ( $button_icon ) {
                                $button_classes[] = 'button-icon';
                                $button_classes[] = 'icon-position-' . $button['icon_position'];
                                $button_icon = '<i class="'. $icon_classes . '" aria-hidden="true" style="'. $icon_styles .'"></i>';
                            }

                        } elseif ( $add_icon_image === 'image' ) {

                            $button_image = $button['button_image'];

                            $icon_image_size = $button['image_size'];
                            if ( $icon_image_size ) {
                                $image_width = $icon_image_size['width'];
                                $image_height = $icon_image_size['height'];
                                $button_icon_styles = 'width: ' . $image_width . 'px; height: ' . $image_height . 'px;';
                            }

                            if ( $button_image ) {

                                $button_classes[] = 'button-image';
                                $button_classes[] = 'icon-position-' . $button['icon_position'];
                                $button_icon = '<img src="' . $button['button_image'] . '" style="'. $button_icon_styles .'" />';

                            }

                        }

                        // additional classes
                        $additional_classes = $button['additional_classes'];
                        if ( $additional_classes ) {
                            $button_classes[] = $additional_classes;
                        }
                        
                        // process button styles
                        $button_classes = implode(' ', $button_classes);
                        $button_styles = implode(' ', $button_styles);
                        $text_classes = implode(' ', $text_classes);

                        $button_tag_start = '<a type="button" href="'. esc_attr($url) .'" title="'. esc_attr($title) .'" class="'. esc_attr($button_classes) .' '. esc_attr($text_classes) .'" style="'. esc_attr($button_styles) .'"'. $target .'>';

                        if ( $text_classes ) {
                            $button_content = '<span class="button-text '. $text_classes .'">' . esc_attr($title) . '</span>';
                        } else {
                            $button_content = esc_attr($title);
                        }

                        $button_tag_end = '</a>';

                        if ( $button_icon && ( ( $button['icon_position'] == 'left' ) || ( $button['icon_position'] == 'top' ) ) ) {
                            echo $button_tag_start . $button_icon . $button_content . $button_tag_end;
                        } elseif ( $button_icon && ( ( $button['icon_position'] == 'right' ) || ( $button['icon_position'] == 'bottom' ) ) ) {
                            echo $button_tag_start . $button_content . $button_icon . $button_tag_end;
                        } else {
                            echo $button_tag_start . $button_content . $button_tag_end;
                        }
                        $secondary_button_enable = get_field('secondary_button', 'style');

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
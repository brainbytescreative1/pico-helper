<?php

if( get_row_layout() == 'icon_list' ):

    // content
    $icon_list = get_sub_field('icon_list');

    if ( $icon_list ) {

        echo '<style>';
            include_once( __DIR__ . '/styles/icon-list.css');
        echo '</style>';
        
        // initialize classes arrays
        $list_container_classes = [];
        $list_classes = [];
        $list_item_classes = [];
        $icon_classes = [];
        $text_classes = [];
        $list_heading_classes = [];

        // settings
        $icon_color = get_sub_field('icon_color');
        $text_color = get_sub_field('text_color');
        $desktop_orientation = get_sub_field('orientation');
        $mobile_orientation = get_sub_field('mobile_orientation');
        $icon_size = get_sub_field('icon_size');
        $alignment = get_sub_field('alignment');
        $mobile_alignment = get_sub_field('mobile_alignment');
        $item_spacing = get_sub_field('icon_spacing');
        $mobile_item_spacing = null;
        $mobile_item_spacing = get_sub_field('mobile_item_spacing');
        $icon_margin = get_sub_field('icon_margin');
        $list_item_vertical_alignment = null;
        $list_item_vertical_alignment = get_sub_field('list_item_vertical_alignment');
        $list_columns = get_sub_field('list_columns');

        // breakpoint
        $breakpoint = 'lg';
        $mobile_breakpoint = null;
        $mobile_breakpoint = get_sub_field('mobile_breakpoint');
        if ( $mobile_breakpoint ) {
            $breakpoint = $mobile_breakpoint;
        }

        // add initial classes
        $list_container_classes[] = 'element';
        $list_container_classes[] = 'icon-list-container';
        $list_classes[] = 'icon-list';
        if ( $list_columns !== 'default' ) {
            $list_classes[] = $list_columns . '-columns-' . $breakpoint . '-list';
        } else {
            $list_classes[] = 'd-flex';
        }

        // push classes to inside loop
        $list_item_classes_field = get_sub_field('list_item_classes');
        $icon_classes_field = get_sub_field('icon_classes');
        $text_classes_field = get_sub_field('text_classes');

        // heading
        $heading = get_sub_field('heading');
        if ( $heading && $heading['text'] && $heading['tag'] ) {
            $heading_position = get_sub_field('heading_position');
            if ( $heading_position == 'left' ) {
                $list_heading_classes[] = 'd-flex';
                $list_heading_classes[] = 'flex-'. $breakpoint .'-row';
                $list_heading_classes[] = 'flex-column';
            } elseif ( $heading_position == 'top' ) {
                $list_heading_classes[] = 'd-flex';
                $list_heading_classes[] = 'flex-column';
            } elseif ( $heading_position == 'right' ) {
                $list_heading_classes[] = 'd-flex';
                $list_heading_classes[] = 'flex-'. $breakpoint .'-row-reverse';
                $list_heading_classes[] = 'flex-column';
            } elseif ( $heading_position == 'bottom' ) {
                $list_heading_classes[] = 'd-flex';
                $list_heading_classes[] = 'flex-column-reverse';
            }
        }

        // orientation
        if ( $desktop_orientation ) {
            $list_classes[] = 'orientation-' . $desktop_orientation;
            if ( $desktop_orientation === 'horizontal' ) {
                $list_classes[] = 'flex-'. $breakpoint .'-row';
            } elseif ( $desktop_orientation === 'vertical' ) {
                $list_classes[] = 'flex-'. $breakpoint .'-column';
            }
        }

        // assign mobile orientation to desktop if empty
        if ( !$mobile_orientation || ( $mobile_orientation === 'default' ) ) {
            $mobile_orientation = $desktop_orientation;
        }

        if ( $mobile_orientation ) {
            $list_classes[] = 'orientation-mobile-' . $mobile_orientation;
            if ( $mobile_orientation === 'horizontal' ) {
                $list_classes[] = 'flex-row';
            } elseif ( $mobile_orientation === 'vertical' ) {
                $list_classes[] = 'flex-column';
            } else {
                $list_classes[] = 'flex-column';
            }
        }

        // alignment

        // assign mobile alignment to desktop if empty
        if ( !$mobile_alignment || ( $mobile_alignment === 'default' ) ) {
            $mobile_alignment = $alignment;
        }

        $align_rule = null;
        if ( $desktop_orientation && ( $desktop_orientation === 'horizontal' ) ) {
            $align_rule = 'justify-content-' . $breakpoint;
        } elseif ( $desktop_orientation && ( $desktop_orientation === 'vertical' ) ) {
            $align_rule = 'align-items-' . $breakpoint;
        }

        $align_rule_mobile = null;
        if ( $mobile_orientation && ( $mobile_orientation === 'horizontal' ) ) {
            $align_rule_mobile = 'justify-content';
        } elseif ( $mobile_orientation && ( $mobile_orientation === 'vertical' ) ) {
            $align_rule_mobile = 'align-items';
        }

        if ( $alignment ) {

            if ( $alignment !== 'default' ) {
            
                if ( $alignment === 'left' ) {
                    $list_classes[] = 'ms-'. $breakpoint .'-0';
                    $list_classes[] = 'me-'. $breakpoint .'-auto';
                    $list_classes[] = $align_rule . '-start';
                } elseif ( $alignment === 'center' ) {
                    $list_classes[] = 'ms-'. $breakpoint .'-auto';
                    $list_classes[] = 'me-'. $breakpoint .'-auto';
                    $list_classes[] = $align_rule . '-center';
                } elseif ( $alignment === 'right' ) {
                    $list_classes[] = 'me-'. $breakpoint .'-0';
                    $list_classes[] = 'ms-'. $breakpoint .'-auto';
                    $list_classes[] = $align_rule . '-end';
                } else {
                    $list_classes[] = 'justify-content-' . $alignment;
                }

            }
            
        }

        if ( $mobile_alignment && ( $mobile_alignment !== 'default' ) ) {

            if ( $mobile_alignment === 'left' ) {
                $list_classes[] = 'ms-0';
                $list_classes[] = 'me-auto';
                $list_classes[] = $align_rule_mobile . '-start';
            }
            if ( $mobile_alignment === 'center' ) {
                $list_classes[] = 'ms-auto';
                $list_classes[] = 'me-auto';
                $list_classes[] = $align_rule_mobile . '-center';
            }
            if ( $mobile_alignment === 'right' ) {
                $list_classes[] = 'me-0';
                $list_classes[] = 'ms-auto';
                $list_classes[] = $align_rule_mobile . '-end';
            }

        }
        
        // spacing
        if ( $item_spacing && ( $item_spacing !== 'default' ) ) {
            if ( !$mobile_item_spacing || ( $mobile_item_spacing === 'default' ) ) {
                $mobile_item_spacing = $item_spacing;
            }
            if ( $item_spacing == 'none' ) {
                $item_spacing = '0';
            }
            if ( $mobile_item_spacing == 'none' ) {
                $mobile_item_spacing = '0';
            }
            // desktop orientation
            if ( $desktop_orientation ) {
                if ( $desktop_orientation == 'horizontal' ) {
                    $list_item_classes[] = 'me-'. $breakpoint .'-' . $item_spacing;
                    $list_item_classes[] = 'mb-'. $breakpoint .'-0';
                } elseif ( $desktop_orientation == 'vertical' ) {
                    $list_item_classes[] = 'mb-'. $breakpoint .'-' . $item_spacing;
                    $list_item_classes[] = 'me-'. $breakpoint .'-0';
                }
            }
            // mobile orientation
            if ( $mobile_orientation ) {
                if ( $mobile_orientation === 'horizontal' ) {
                    $list_item_classes[] = 'me-'. $mobile_item_spacing;
                    $list_item_classes[] = 'mb-0';
                } elseif ( $mobile_orientation === 'vertical' ) {
                    $list_item_classes[] = 'mb-'. $mobile_item_spacing;
                    $list_item_classes[] = 'me-0';
                }
            } else {
                $list_item_classes[] = 'mb-'. $item_spacing;
            }
        }

        // spacing
        if ( function_exists('get_spacing_bbc') ) {
            $list_classes[] = esc_attr(trim(get_spacing_bbc(get_sub_field('icon_list_spacing'))));
        }
        if ( function_exists('get_spacing_bbc') ) {
            $list_container_classes[] = esc_attr(trim(get_spacing_bbc(get_sub_field('list_container_spacing'))));
        }

        // advanced
        $unique_id = get_sub_field('unique_id');
        
        $list_container_classes_field = get_sub_field('list_container_classes');
        if ( $list_container_classes_field ) {
            $list_container_classes[] = $list_container_classes_field;
        }
        $list_classes_field = get_sub_field('list_classes');
        if ( $list_classes_field ) {
            $list_classes[] = $list_classes_field;
        }
        //$list_item_classes_field = get_sub_field('list_item_classes');
        if ( $list_item_classes_field ) {
            $list_item_classes[] = $list_item_classes_field;
        }
        //$icon_classes_field = get_sub_field('icon_classes');
        if ( $icon_classes_field ) {
            $icon_classes[] = $icon_classes_field;
        }
        //$text_classes_field = get_sub_field('text_classes');
        if ( $text_classes_field ) {
            $text_classes[] = $text_classes_field;
        }

        if ( $list_item_vertical_alignment ) {
            if ( $list_item_vertical_alignment === 'start' ) {
                $list_item_classes[] = 'align-items-start';
            }
            if ( $list_item_vertical_alignment === 'center' ) {
                $list_item_classes[] = 'align-items-center';
            }
            if ( $list_item_vertical_alignment === 'end' ) {
                $list_item_classes[] = 'align-items-end';
            }
        } else {
            $list_item_classes[] = 'align-items-center';
        }

        // process classes array
        $list_container_classes = esc_attr( trim( implode(' ', $list_container_classes ) ) );
        $list_classes = esc_attr( trim( implode(' ', $list_classes ) ) );
        $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );

        // output
        echo '<div class="'. $list_container_classes .'">'; // start list container

        if ( $heading && $heading['text'] && $heading['tag'] ) {
            $list_heading_classes[] = 'icon-list-heading';
            if ( ( $heading_position === 'top' ) || ( $heading_position === 'bottom' ) ) {
                $list_heading_classes[] = 'w-100';
            } else {
                $list_heading_classes[] = 'flex-shrink-1';
            }
            $list_heading_classes = esc_attr( trim( implode(' ', $list_heading_classes ) ) );

            if ( function_exists('get_heading_bbc') ) {
                echo '<div class="'. $list_heading_classes .'">' . get_heading_bbc($heading) . '</div>';
            }

        }

            echo '<ul class="'. $list_classes .'">'; // icon list start

                foreach( $icon_list as $icon ) {

                    $return_icon = get_icon_bbc($icon['icon']);

                    // initialize classes arrays
                    $icon_classes = [];
                    $icon_styles = [];
                    $text_classes = [];
                    $link_text_classes = [];
                    $list_item_classes = explode(' ', $list_item_classes);

                    // get icon fields
                    $link = $icon['link'];
                    $separator = $icon['separator'];
                    $text_content = $icon['text_content'];

                    // add classes
                    $icon_classes[] = 'icon';
                    $icon_classes[] = 'mb-0';
                    $icon_classes[] = $icon_classes_field;
                    $text_classes[] = $text_classes_field;

                    if ( $icon_color['theme_colors'] ) {
                        $icon_classes[] = 'text-' . $icon_color['theme_colors'];
                    }
                    if ( $icon_color['theme_colors'] ) {
                        $text_classes[] = 'text-' . $text_color['theme_colors'];
                    }

                    if ( $icon_size !== 'default' ) {
                        $icon_classes[] = $icon_size;
                    }
                    
                    if ( $icon_margin && ( $icon_margin !== 'default' ) ) {
                        if ( $icon_margin === 'none' ) {
                            $icon_classes[] = 'me-0';
                            $list_item_classes[] = 'me-0';
                        } else {
                            $icon_classes[] = 'me-' . $icon_margin;
                            $list_item_classes[] = 'me-' . $icon_margin;
                        }
                    }

                    $icon_margin_top = get_sub_field('icon_margin_top');
                    if ( $icon_margin_top ) {
                        $icon_margin_top = ' style="position: relative; top: ' . $icon_margin_top . 'px;"';
                    }

                    if ( $separator && ( $separator === 'add' ) ) {
                        if ( $desktop_orientation === 'horizontal' ) {
                            $icon_styles[] = 'border-right: 1px solid var(--' . $icon_color['theme_colors'] . ');';
                            $list_item_classes[] = 'pe-' . $breakpoint . '-' . $item_spacing;
                            $list_item_classes[] = 'pe-' . $mobile_item_spacing;
                        } elseif ( $desktop_orientation === 'vertical' ) {
                            $icon_styles[] = 'border-bottom: 1px solid var(--' . $icon_color['theme_colors'] . ');';
                            $list_item_classes[] = 'pb-' . $breakpoint . '-' . $item_spacing;
                            $list_item_classes[] = 'pb-' . $mobile_item_spacing;
                        }
                    }

                    // process arrays
                    if ( $icon_classes ) {
                        $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                    } else {
                        $icon_classes = null;
                    }

                    if ( $icon_styles ) {
                        $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                    } else {
                        $icon_styles = null;
                    }
                    
                    if ( $text_classes ) {
                        $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );
                    } else {
                        $text_classes = null;
                    }

                    if ( $link_text_classes ) {
                        $link_text_classes = esc_attr( trim( implode(' ', $link_text_classes ) ) );
                    } else {
                        $link_text_classes = null;
                    }
                    
                    if ( $list_item_classes ) {
                        $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );
                    } else {
                        $list_item_classes = null;
                    }

                    if ( $link ) {
                        $url = $link['url'];
                        $title = $link['title'];
                        $target = $link['target'];
                        ?>
                        <li class="<?=$list_item_classes?>">
                            <a href="<?=$url?>" title="<?=$url?>" class="" target="<?=$target?>">
                                <?php if ( $return_icon ) { ?>
                                    <span class="<?=$icon_classes?>"<?=$icon_margin_top?>>
                                        <?=$return_icon?>
                                    </span>
                                <?php } ?>
                                <?php if ( $title ) { ?>
                                    <span class="<?=$text_classes?>">
                                        <?=$title?>
                                    </span>
                                <?php } ?>
                            </a>
                        </li>
                        <?php

                    } elseif ( $text_content ) { ?>

                        <li class="<?=$list_item_classes?>">
                            <?php if ( $return_icon ) { ?>
                                <span class="<?=$icon_classes?>"<?=$icon_margin_top?>>
                                    <?=$return_icon?>
                                </span>
                            <?php } ?>
                            <?php if ( $text_content ) { ?>
                                <span class="<?=$text_classes?>">
                                    <?=$text_content?>
                                </span>
                            <?php } ?>
                        </li>
                        
                    <?php } else { ?>

                        <li class="<?=$list_item_classes?>">
                            <?php if ( $icon['icon'] ) { ?>
                                <span class="<?=$icon_classes?>"<?=$icon_margin_top?>>
                                    <i class="<?=$icon['icon']?>" aria-hidden="true"></i>
                                </span>
                            <?php } ?>
                        </li>

                    <?php }

                }

            echo '</ul>'; // icon list end

        echo '</div>'; // end list container

    }

endif;
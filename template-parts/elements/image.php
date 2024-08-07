<?php

if( get_row_layout() == 'image' ):
                                        
    $image = get_sub_field('image');
    
    if( $image ):

        $image_url = wp_get_attachment_image_url( $image );

        if( $image_url ):

            $classes = [];
            $styles = [];

            $classes[] = 'img';
            $classes[] = 'element';

            $image_classes = [];
            $image_styles = [];

            $link_wrapper_tag = 'div';
            $image_link = get_sub_field('image_link');

            // size
            $size = get_sub_field('image_size');
            $size_max_width = null;
            switch ($size) {
                case 'full':
                    $size = '2048x2048';
                    $size_max_width = '1920px';
                    break;
                case '1536x1536':
                    $size_max_width = '1536px';
                    break;
                case 'large':
                    $size_max_width = '1024px';
                    break;
                case 'medium_large':
                    $size_max_width = '768px';
                    break;
                case 'medium':
                    $size_max_width = '300px';
                    break;
                case 'thumbnail':
                    $size_max_width = '150px';
                    break;
            }

            // alt text and title
            $image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
            $image_title = get_the_title($image);
            if ( get_sub_field('alt_text_override') ) {
                $image_alt = get_sub_field('alt_text_override');
            }

            if ( $image_link ) {

                $title = $image_link['title'];
                $url = $image_link['url'];
                $target = $image_link['target'];
                if ( $target ) {
                    $target = ' target="' . $target . ' "';
                }

                $link_wrapper_tag = 'a '. $target .' href="'. $url .'"';

                //$styles[] = 'max-width: ' . $size_max_width;

            }

            // image settings
            $image_alignment = get_sub_field('image_alignment');
            if ( $image_alignment ) {
                if ( $image_alignment == 'left' ) {
                    $classes[] = 'align-left';
                    $classes[] = 'me-auto';
                } elseif ( $image_alignment == 'center' ) {
                    $classes[] = 'align-center';
                    $classes[] = 'ms-auto';
                    $classes[] = 'me-auto';
                } elseif ( $image_alignment == 'right' ) {
                    $classes[] = 'align-right';
                    $classes[] = 'ms-auto';
                }
            }

            $border_radius = get_sub_field('border_radius');
            if ( $border_radius && ( $border_radius !== 'none' ) ) {
                $classes[] = 'rounded';
                if ( $border_radius === 'default' ) {
                    $classes[] = 'rounded-3';
                    $classes[] = 'overflow-hidden';
                } else {
                    $classes[] = 'rounded-' . $border_radius;
                    $classes[] = 'overflow-hidden';
                }
                
            }

            $image_bottom_margin = get_sub_field('image_bottom_margin');
            if ( $image_bottom_margin && ( $image_bottom_margin === 'disabled' ) ) {
                $classes[] = 'mb-0';
            }

            $force_full_width = get_sub_field('force_full_width');
            if ( $force_full_width === 'yes' ) {
                $classes[] = 'force-full-width';
            }

            $force_full_width_tablet = get_sub_field('force_full_width_tablet');
            if ( $force_full_width_tablet === 'yes' ) {
                $classes[] = 'force-full-width-tablet';
            }

            $force_full_width_mobile = get_sub_field('force_full_width_mobile');
            if ( $force_full_width_mobile === 'yes' ) {
                $classes[] = 'force-full-width-mobile';
            }

            if ( function_exists('get_spacing_bbc') ) {
                $classes[] = get_spacing_bbc(get_sub_field('image_spacing'));
            }
            
            if ( function_exists('get_responsive_bbc') ) {
                $classes[] = get_responsive_bbc('responsive');
            }

            if ( function_exists('get_sizing_bbc') ) {
                $sizing = get_sizing_bbc(get_sub_field('sizing'));
                $image_classes[] = $sizing['classes'];
                $image_styles[] = $sizing['styles'];
            }

            $additional_classes = get_sub_field('additional_classes');
            if ( $additional_classes ) {
                $classes[] = trim($additional_classes);
            }
            
            // add max width to wrapper
            $image_attributes = wp_get_attachment_image_src( $image, 'full' );

            if ( $image_attributes && $image_attributes[1] ) {
                $styles[] = 'max-width: ' . $image_attributes[1] . 'px;';
            }

            $classes = trim(implode(' ', $classes));
            $styles = trim(implode(' ', $styles));

            $image_classes = trim(implode(' ', $image_classes));
            $image_styles = trim(implode(' ', $image_styles));

            echo '<'.$link_wrapper_tag.' class="'. $classes . '" style="'. $styles .'">';
                if ( function_exists('get_responsive_image_bbc') ) { 
                    echo get_responsive_image_bbc($image, $size, $size_max_width, $image_alt, $image_classes, $image_styles);
                }
            echo '</'.$link_wrapper_tag.'>';
    
        endif;
    
    endif;

endif;
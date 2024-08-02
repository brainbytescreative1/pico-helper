<?php
/*
Accepts 2 parameters
$field = get ACF name (required)
$sub = whether the field is an ACF sub-field (optional)
*/
function get_background_bbc($field, $sub = false) {
    
    if ( $field ) {

        $return_overlay = null;
        $return_styles = [];

        // get background field
        $background = null;
        if ( $sub === true ) {
            $background = get_sub_field($field);
        } else {
            $background = get_field($field);
        }

        if ( $background ) {

            $content = null;
            if ( function_exists('if_array_value') ) {
                $content = if_array_value($background, 'content');
            }

            if ( $content !== 'none' ) {

                // color overlay
                $overlay = null;
                $overlay_color = null;
                $overlay_classes = [];
                $overlay_classes[] = 'overlay';
                $color = null;
                if ( function_exists('if_array_value') ) {
                    $color = if_array_value($background, 'color');
                }
                $breakpoint = null;
                if ( function_exists('if_array_value') ) {
                    $breakpoint = if_array_value($background, 'background_mobile_breakpoint');
                    if ( $breakpoint === 'default' ) {
                        $breakpoint = 'md';
                    }
                } else {
                    $breakpoint = 'md';
                }

                // gradient
                $gradient = null;
                if ( function_exists('if_array_value') ) {
                    $gradient = if_array_value($background, 'background_gradient');
                }
                if ( $gradient ) {
                    $overlay_color = $gradient;
                } elseif ( $color ) {
                    if ( function_exists('get_rgb_color_bbc') ) {
                        $overlay_color = get_rgb_color_bbc($color, false);
                    }
                }

                // overlay
                $overlay_visibility = null;
                if ( function_exists('if_array_value') ) {
                    $overlay_visibility = if_array_value($background, 'overlay_visibility');
                    if ( $overlay_visibility === 'mobile' ) {
                        $overlay_classes[] = 'd-' . $breakpoint . '-none';
                        $overlay_classes[] = 'd-block';
                    } elseif ( $overlay_visibility === 'desktop' ) {
                        $overlay_classes[] = 'd-' . $breakpoint . '-block';
                        $overlay_classes[] = 'd-none';
                    }
                }
                
                if ( function_exists('if_array_value') ) {
                    $overlay_blend_mode = if_array_value($background, 'overlay_blend_mode');
                    if ( $overlay_blend_mode && ( $overlay_blend_mode !== 'normal' ) ) {
                        $overlay_classes[] = 'blend-' . $overlay_blend_mode;
                    }
                }
                if ( function_exists('if_array_value') ) {
                    $overlay_color_display = if_array_value($background, 'overlay_color_display');
                }
                $overlay_classes = trim( implode(' ', $overlay_classes) );

                if ( $overlay_color ) {
                    $return_styles[] = 'background-color: ' . $overlay_color . ';';
                    $overlay = '<div class="'. $overlay_classes.'" style="background: '. $overlay_color .'"></div>';
                }

                // image
                $image = null;
                if ( function_exists('if_array_value') ) {
                    $image = if_array_value($background, 'image');
                }

                $image_mobile = null;
                if ( function_exists('if_array_value') ) {
                    $image_mobile = if_array_value($background, 'image_upload_mobile');
                }

                /*
                $image_source = null;
                if ( function_exists('if_array_value') ) {
                    $image_source = if_array_value($background, 'background_image_source');
                }
                if ( $image_source === 'featured' ) {
                    $post_id = get_the_ID();
                    $featured_image = get_post_thumbnail_id($post_id);
                    if ( $featured_image ) {
                        $image = $featured_image;
                    }
                }
                */

                // initialize image mobile
                $image_classes_mobile = [];
                $image_classes_mobile[] = 'bg-image';
                $image_classes_mobile[] = 'd-block';
                $image_classes_mobile[] = 'd-' . $breakpoint . '-none';
                
                // initialize image desktop
                $image_classes = [];
                $image_classes[] = 'bg-image';
                $image_classes[] = 'd-none';
                $image_classes[] = 'd-' . $breakpoint . '-block';

                // alt text
                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                $image_alt_mobile = get_post_meta($image_mobile, '_wp_attachment_image_alt', TRUE);

                // if no separate mobile image, assign to desktop
                if ( !$image_mobile ) {
                    $image_mobile = $image;
                    $image_alt_mobile = $image_alt;
                }

                // background object fit
                $object_fit = null;
                if ( function_exists('if_array_value') ) {
                    $object_fit = if_array_value($background, 'size');
                }
                $object_fit_mobile = null;
                if ( function_exists('if_array_value') ) {
                    $object_fit_mobile = if_array_value($background, 'background_size_mobile');
                }
                if ( $object_fit_mobile !== 'default' ) {
                    $image_classes[] = 'object-fit-md-' . $object_fit;
                    $image_classes[] = 'object-fit-' . $object_fit_mobile;

                    $image_classes_mobile[] = 'object-fit-md-' . $object_fit;
                    $image_classes_mobile[] = 'object-fit-' . $object_fit_mobile;
                } else {
                    $image_classes[] = 'object-fit-' . $object_fit;
                    $image_classes_mobile[] = 'object-fit-' . $object_fit;
                }

                // background object position
                $position = null;
                if ( function_exists('if_array_value') ) {
                    $position = if_array_value($background, 'position');
                }
                if ( $position ) {
                    $position = str_replace(' ', '-', $position);
                }
                $position_mobile = null;
                if ( function_exists('if_array_value') ) {
                    $position_mobile = if_array_value($background, 'background_position_mobile');
                }
                if ( $position_mobile ) {
                    $position_mobile = str_replace(' ', '-', $position_mobile);
                }
                if ( $position_mobile !== 'default' ) {
                    $image_classes[] = 'object-position-'. $breakpoint .'-' . $position;
                    $image_classes[] = 'object-position-' . $position_mobile;

                    $image_classes_mobile[] = 'object-position-'. $breakpoint .'-' . $position;
                    $image_classes_mobile[] = 'object-position-' . $position_mobile;
                } else {
                    $image_classes[] = 'object-position-' . $position;
                    $image_classes_mobile[] = 'object-position-' . $position;
                }

                // image max width
                $image_size = null;
                if ( function_exists('if_array_value') ) {
                    $image_size = if_array_value($background, 'background_image_size');
                }
                $size_max_width = null;
                switch ($image_size) {
                    case 'full':
                        $image_size = '2048x2048';
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

                $image_classes_mobile = trim( implode(' ', $image_classes_mobile) );
                $image_classes = trim( implode(' ', $image_classes) );                

                // video
                $video = null;
                if ( function_exists('if_array_value') ) {
                    $video = if_array_value($background, 'video');
                }

                // output start
                ob_start();

                echo '<div class="bg-container">'; // bg container start

                    echo '<div class="bg-image-container-wrapper">'; // bg container start

                        // image
                        if ( $image && ( ( $content === 'image' ) || ( $content === 'video' ) ) ) {
                            echo '<div class="bg-image-container">'; // bg image container start
                            if ( function_exists('get_responsive_image_bbc') ) { 
                                echo get_responsive_image_bbc($image, $image_size, $size_max_width, $image_alt, $image_classes );
                                echo get_responsive_image_bbc($image_mobile, 'medium_large', '768', $image_alt, $image_classes_mobile );
                            }
                            echo '</div>'; // bg image container end

                            // video
                            if ( $video && ( $content === 'video' ) ) {
                                echo '<video class="video-bg mobile-hide" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="'. $video .'" type="video/mp4" /></video>';
                            }
                        }

                    echo '</div>'; // bg container start

                    // overlay
                    if ( $overlay ) {
                        echo $overlay;
                    }

                echo '</div>'; // bg container end

                $return_overlay = ob_get_clean();

                return Array( $return_overlay );
                
            }

        }

    }

}

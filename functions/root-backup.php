<?php

function global_site_variables(){

    // assign color list
    $colors = [
        'text',
        'primary',
        'secondary',
        'success',
        'info',
        'danger',
        'warning',
        'light',
        'gray',
        'dark',
        'white'
    ];

    // initialize variables
    foreach ( $colors as $color ) {
        $color = null;
    }

    // typography
    $base_font_size = '16';
    $base_font_weight = '400';
    $max_width = null;
    $section_padding = null;
    $button_border = null;
    $border_radius = null;
    $button_letter_spacing = null;

    // logo
    $logo_width = null;
    $sticky_logo_width = null;
    $logo_width = get_field('logo_width', 'header');
    $sticky_logo_width = get_field('sticky_logo_width', 'header');

    // main menu style
    $main_menu_text_color = null;
    $main_menu_text_color = get_field('main_text_color', 'header');
    $main_menu_font_family = null;
    $main_menu_font_family = get_field('main_menu_font_family', 'header');
    $main_menu_font_weight = null;
    $main_menu_font_weight = get_field('main_menu_font_weight', 'header');
    $header_height = null;
    $header_height = get_field('header_height', 'header');

    // typography
    $base_font_size = get_field('base_font_size', 'style');
    $base_font_weight = get_field('base_font_weight', 'style');
    $primary_font = get_field('primary_font', 'style');
    $secondary_font = get_field('secondary_font', 'style');
    $text_link_color = get_field('text_link_color', 'style');
    $text_link_weight = get_field('text_link_weight', 'style');

    // containers & columns
    $max_width = get_field('max_width', 'style');

    // buttons
    $button_border = get_field('button_border', 'style');
    if ( $button_border == 'radius' ) {
        $border_radius = get_field('border_radius', 'style');
    } elseif ( $button_border == 'square' ) {
        $border_radius = '0';
    } elseif ( $button_border == 'round' ) {
        $border_radius = '1000';
    }

    echo '<style>'; // style start
    echo "\r\n";

    echo ':root {'; // root start
    echo "\r\n";
    echo "\r\n";
    /* typography */
    /* colors */
    foreach ( $colors as $color ) {
        $color_value = get_field($color, 'style');
        $color_hover_value = get_field($color . '_hover', 'style');

        if ( $color_value ) {
            echo '--' . $color . ': ' . $color_value .';';
            echo "\r\n";
        }
        if ( $color_hover_value ) {
            echo '--' . $color . '_hover: ' . $color_hover_value .';';
            echo "\r\n";
        }
    }

    /* row gap */
    $horizontal_gap = get_field('horizontal_gap', 'style');
    if ( $horizontal_gap ) {
        echo '--custom-gutter-x: '.$horizontal_gap.'rem;';
        echo "\r\n";
        echo '--custom-gutter-neg: -'.$horizontal_gap.'rem;';
        echo "\r\n";
    } else {
        echo '--custom-gutter-x: 1.5rem;';
        echo "\r\n";
        echo '--custom-gutter-neg: -1.5rem;';
        echo "\r\n";
    }

    /* buttons */
    foreach ( $colors as $button_color ) {
        $button_color_background = null;
        $button_color_color = null;
        $button_color_button = get_field($button_color . '_button', 'style');
        if ( $button_color_button ) {
            if ( isset( $button_color_button[$button_color . '_background'] ) ) {
                if ( isset( $button_color_button[$button_color . '_background']['theme_colors'] ) ) {
                    $button_color_background = $button_color_button[$button_color . '_background']['theme_colors'];
                    $button_color_color = $button_color_button[$button_color . '_color']['theme_colors'];
                }
            } 
        }
        if ( $button_color_background ) {
            echo '--' . $button_color .'_background: var(--' . $button_color_background . ');';
            echo "\r\n";
        }
        if ( $button_color_color ) {
            echo '--' . $button_color .'_color: var(--' . $button_color_color . ');';
            echo "\r\n";
        }
    }
    echo '--text-background: #000000;';
    echo "\r\n";

    /* logo & header */
    if ( $logo_width ) {
        echo '--logo_width: '. $logo_width. 'px;';
        echo "\r\n";
    }
    if ( $sticky_logo_width ) {
        echo '--sticky_logo_width: '. $sticky_logo_width .'px;';
        echo "\r\n";
    }
    if ( $header_height ) {
        echo '--header_height: ' . $header_height . 'px;';
        echo "\r\n";
    } else {
        echo '--header_height: 0px;';
        echo "\r\n";
    }
    if ( $header_height && is_user_logged_in() ) {
        $header_height_desktop = $header_height + 32;
        echo '--header_height_logged_in: ' . $header_height_desktop . 'px;';
        echo "\r\n";
        $header_height_mobile = $header_height + 28;
        echo '--header_height_logged_in_mobile: ' . $header_height_mobile . 'px;';
        echo "\r\n";
    } else {
        echo '--header_height_logged_in: 32px;';
        echo "\r\n";
        echo '--header_height_logged_in_mobile: 8px;';
        echo "\r\n";
    }

    $menu_padding = get_field('main_menu_padding_updated', 'header');
    if ( $menu_padding !== 'default' ) {
        echo '--bs-navbar-padding-y-custom: ' . $menu_padding . ';';
        echo "\r\n";
    } else {
        echo '--bs-navbar-padding-y-custom: 1.5rem;';
        echo "\r\n";
    }
    
    /*
    if ( function_exists('get_menu_padding_bbc') ) {
        $menu_padding = get_menu_padding_bbc(get_field('main_menu_padding_updated', 'header'), $wrapper_classes, $wrapper_styles);
        
    }
        */

    /* typography */
    if ( $base_font_size ) {
        echo '--base_font_size: '. $base_font_size. 'px;';
        echo "\r\n";
    } else {
        echo '--base_font_size: 16px;';
        echo "\r\n";
    }

    /* font weight */
    if ( $base_font_weight && ( $base_font_weight !== 'default' ) ) {
        echo '--bs-body-font-weight: '. $base_font_weight .';';
        echo "\r\n";
    }

    /* sections */
    if ( $max_width ) {
        echo '--max-width: '. $max_width .'px;';
        echo "\r\n";
    } else {
        echo '--max-width: 1468px;';
        echo "\r\n";
    }

    /* font families */
    if ( $primary_font ) {
        echo '--font-primary: '. $primary_font .';';
        echo "\r\n";
        echo '--bs-body-font-family: var(--font-primary);';
        echo "\r\n";
    }
    if ( $secondary_font ) {
        echo '--font-secondary: '. $secondary_font .';';
        echo "\r\n";
    }

    /* text link color */
    if ( if_array_value($text_link_color, 'theme_colors') ) {
        if ( $text_link_color['theme_colors'] ) {
            echo '--bs-link-color: var(--'.$text_link_color['theme_colors'].');';
            echo "\r\n";
            echo '--bs-link-hover-color: var(--' .$text_link_color['theme_colors']. ');';
            echo "\r\n";
            echo '--bs-link-hover-color: var(--'. $text_link_color['theme_colors']. '_hover);';
            echo "\r\n";
        }
    }

    /* text link weight */
    if ( $text_link_weight && ( $text_link_weight !== 'default' ) ) {
        echo '--bs-link-weight: '. $text_link_weight .';';
        echo "\r\n";
    }

    /* header */
    if ( if_array_value($main_menu_text_color, 'theme_colors') ) {
        if ( $main_menu_text_color['theme_colors'] ) {
            echo '--main_menu_text_color: var(--'. $main_menu_text_color['theme_colors'] .');';
            echo "\r\n";
        }
    }

    /* buttons */
    if ( $border_radius ) {
        echo '--button_border-radius: '. $border_radius .'px;';
        echo "\r\n";
    }

    $border_width = get_field('border_width', 'style');
    if ( $border_width ) {
        echo '--button_border_width: '. $border_width .'px;';
        echo "\r\n";
    }
    
    $button_font_weight = get_field('button_font_weight', 'style');
    if ( $button_font_weight ) {
        echo '--button_font_weight: '. $button_font_weight .';';
        echo "\r\n";
    }
    
    $button_font_family = get_field('button_font_family', 'style');
    if ( $button_font_family !== 'default' ) {
        echo '--button_font_family: var(--font-'. $button_font_family .');';
        echo "\r\n";
    }
    
    $button_letter_spacing = get_field('button_letter_spacing', 'style');
    if ( $button_letter_spacing ) {
        echo '--button_letter_spacing: '. $button_letter_spacing. 'px;';
        echo "\r\n";
    }

    $radius_values = [
        [ '1', 'sm' ],
        [ '2', 'md' ],
        [ '3', 'lg' ],
        [ '4', 'xl' ],
        [ '5', 'xxl' ]
    ];

    // desktop radius
    foreach ( $radius_values as $radius_value ) {
        $desktop_radius = get_field('desktop_radius_' . $radius_value[0], 'style');
        if ( $desktop_radius ) {
            echo '--bs-border-radius-'. $radius_value[1] .': ' . $desktop_radius . 'rem;';
            echo "\r\n";
        }
        $mobile_radius = get_field('mobile_radius_'. $radius_value[0], 'style');
        if ( $mobile_radius ) {
            echo '--mobile-border-radius-'. $radius_value[1] .': ' . $mobile_radius . 'rem;';
            echo "\r\n";
        }
    }
    /* main menu */
    if ($main_menu_font_family && ( $main_menu_font_family !== 'default')) {
        echo '--main_menu_font_family: ' . 'var(--font-'. $main_menu_font_family .');';
        echo "\r\n";
    }
    // main font weight
    if ($main_menu_font_weight && ( $main_menu_font_weight !== 'default')) {
        echo '--main_menu_font_weight: '. $main_menu_font_weight .';';
        echo "\r\n";
    }

    
    echo '.editor-styles-wrapper .bg-primary {';
    echo 'background-color: var(--primary) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-secondary {';
    echo 'background-color: var(--secondary) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-success {';
    echo 'background-color: var(--success) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-info {';
    echo 'background-color: var(--info) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-danger {';
    echo 'background-color: var(--danger) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-warning {';
    echo 'background-color: var(--warning) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-light {';
    echo 'background-color: var(--light) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-dark {';
    echo 'background-color: var(--dark) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-gray {';
    echo 'background-color: var(--gray) !important;';
    echo '}';
    echo '.editor-styles-wrapper .bg-white {';
    echo 'background-color: var(--white) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-primary {';
    echo 'color: var(--primary) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-secondary {';
    echo 'color: var(--secondary) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-success {';
    echo 'color: var(--success) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-info {';
    echo 'color: var(--info) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-danger {';
    echo 'color: var(--danger) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-warning {';
    echo 'color: var(--warning) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-light {';
    echo 'color: var(--light) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-dark {';
    echo 'color: var(--dark) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-gray {';
    echo 'color: var(--gray) !important;';
    echo '}';
    echo '.editor-styles-wrapper .text-white {';
    echo 'color: var(--white) !important;';
    echo '}';
    

    echo "\r\n";
    echo '}'; // root end
    echo "\r\n";

    $headings = [
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
    ];

    foreach ( $headings as $tag) { 
        $heading = get_field($tag, 'style');

        if ( $tag ) {

            echo '.front '. $tag .',';
            echo "\r\n";
            echo '.front .'. $tag .',';
            echo "\r\n";
            echo '.edit-post-visual-editor '. $tag .':not(.wp-block-post-title),';
            echo "\r\n";
            echo '.edit-post-visual-editor .'. $tag .':not(.wp-block-post-title) {';
            echo "\r\n";

                // family
                if ( isset( $heading['font_family'] ) ) {
                    if ( $heading['font_family'] ) {
                        echo 'font-family: var(--font-' . $heading['font_family'] . ');';
                        echo "\r\n";
                    }
                }
                // color
                if ( isset( $heading['theme_colors'] ) ) {
                    if ( $heading['theme_colors'] ) {
                        echo 'color: var(--' . $heading['theme_colors'] . ');';
                        echo "\r\n";
                    }
                }
                // weight
                if ( isset( $heading['font_weight'] ) ) {
                    if ( $heading['font_weight'] ) {
                        echo 'font-weight: ' . $heading['font_weight'] . ';';
                        echo "\r\n";
                    }
                }

            echo '}';
            echo "\r\n";
            echo "\r\n";


            // size
            if ( isset( $heading['font_size'] ) ) {
                if ( $heading['font_size'] ) {
                    if ( isset( $heading['font_size']['value'] ) ) {
                        if ( $heading['font_size']['value'] ) {
                            echo '@media screen and (min-width: 992px) {';
                            echo "\r\n";
                            echo '.front '. $tag .',';
                            echo "\r\n";
                            echo '.front .'. $tag .',';
                            echo "\r\n";
                            echo '.edit-post-visual-editor '. $tag .':not(.wp-block-post-title),';
                            echo "\r\n";
                            echo '.edit-post-visual-editor .'. $tag .':not(.wp-block-post-title) {';
                            echo "\r\n";

                                echo 'font-size: ' . $heading['font_size']['value'] . $heading['font_size']['unit'] . ';';
                                echo "\r\n";

                            echo '}';
                            echo "\r\n";
                            echo '}';
                            echo "\r\n";
                        }
                    }
                }
            } 
        }
    }

    $section_dividers = [];
    $section_dividers = get_field('section_dividers', 'dividers');
    if ( $section_dividers ) {
        foreach ( $section_dividers as $divider ) {

            $shape = $divider['shape'];
            $class = $divider['shape_class'];
            $width = $divider['width'];
            $height = $divider['height'];

            $tablet_height = $height / 2;
            $mobile_height = $height / 3;

            ?>
            <?='.'?><?=$class?> .divider-inner {
                mask: url('<?=$shape?>') no-repeat;
                -webkit-mask: url('<?=$shape?>') no-repeat;
                mask-size: <?=$width?>% <?=$height?>%;
                -webkit-mask-size: <?=$width?>% <?=$height?>px;
                width: <?=$width?>%;
                height: <?=$height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-top {
                margin-top: -<?=$height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-top .row {
                margin-top: <?=$height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-bottom {
                margin-bottom: -<?=$height?>px;
            }
            <?='.'?><?=$class?>-container-negative-margin-bottom .row {
                margin-bottom: <?=$height?>px;
            }
            @media screen and (max-width: 991px) {
                <?='.'?><?=$class?> .divider-inner {
                    mask-size: <?=$width?>% <?=$tablet_height?>% !important;
                    -webkit-mask-size: <?=$width?>% <?=$tablet_height?>px !important;
                    height: <?=$tablet_height?>px !important;
                }
                <?='.'?><?=$class?>-container-negative-margin-top {
                    margin-top: -<?=$tablet_height?>px;
                }
                <?='.'?><?=$class?>-container-negative-margin-top .row {
                    margin-top: <?=$tablet_height?>px;
                }
                <?='.'?><?=$class?>-container-negative-margin-bottom {
                    margin-bottom: -<?=$tablet_height?>px;
                }
                <?='.'?><?=$class?>-container-negative-margin-bottom .row {
                    margin-bottom: <?=$tablet_height?>px;
                }
            }
            @media screen and (max-width: 768px) {
                <?='.'?><?=$class?> .divider-inner {
                    mask-size: <?=$width?>% <?=$mobile_height?>% !important;
                    -webkit-mask-size: <?=$width?>% <?=$mobile_height?>px !important;
                    height: <?=$mobile_height?>px !important;
                }
                <?='.'?><?=$class?>-container-negative-margin-top {
                    margin-top: -<?=$mobile_height?>px;
                }
                <?='.'?><?=$class?>-container-negative-margin-top .row {
                    margin-top: <?=$mobile_height?>px;
                }
                <?='.'?><?=$class?>-container-negative-margin-bottom {
                    margin-bottom: -<?=$mobile_height?>px;
                }
                <?='.'?><?=$class?>-container-negative-margin-bottom .row {
                    margin-bottom: <?=$mobile_height?>px;
                }
            }
            <?php
        }
    }


    $theme_css = get_field('theme_css', 'css');
    if ( $theme_css ) {
    echo $theme_css;
    }
    echo "\r\n";

    echo '</style>'; // style end
    echo "\r\n";

}

// add site settings css variables
add_action('wp_head', 'global_site_variables');
add_action('admin_head', 'global_site_variables');
//add_action('enqueue_block_assets', 'global_site_variables');